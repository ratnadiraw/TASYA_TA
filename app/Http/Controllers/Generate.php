<?php

namespace App\Http\Controllers;

use App\AreaKeilmuan;
use App\Dosen;
use App\DosenTemp;
use App\SubTopik;
use App\TempGenerate;
use App\TempMake;
use App\TempSelect;
use App\TopikExcel;
use App\TopikTemp;
use Chumper\Zipper\Zipper;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\DB;
use \stdClass;

class Generate extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(\Maatwebsite\Excel\Excel $excel)
    {
//        $this->middleware('auth');
        $this->excel = $excel;
    }

    public function index()
    {
        return view('generate.home');
    }

    public function input(Request $request) {
        if ($request->file('excel')->isValid()) {
            $Path = $request->file('excel')->getRealPath();
            $zipper = new Zipper();
//            echo "TES";
            TempMake::truncate();
            TempSelect::truncate();
            $zipper->make($Path)->extractTo('ExtractZip');
            foreach (glob("ExtractZip/*.xlsx") as $filename) {
//                echo "$filename size " . filesize($filename) . "\n";
                $this->excel->load($filename, function ($reader) {
                    $sheet = $reader->getSheet(0); // sheet with name data, but you can also use sheet indexes.
                    //nama nim
                    $nim =  $sheet->getCell('B6');
                    $nama =  $sheet->getCell('B5');

                    $gob = 8;
                    while ($sheet->getCell('A'.$gob) != "Prioritas"){
//                        echo $sheet->getCell('A'.$gob);
                        $gob++;
                    }
                    $gob++;
                    $no =  $sheet->getCell('B'.$gob);

                    if ($no != "" && $no != "-"){
                        $judul = $sheet->getCell('C'.$gob);
                        $prio = $sheet->getCell('A'.$gob);
                        $tempselect = new TempSelect();
                        $tempselect->judul =  $judul;
                        $tempselect->no =  $no;
                        $tempselect->prioritas =  $prio;
                        $tempselect->nim =  $nim;
                        $tempselect->nama =  $nama;
                        $tempselect->save();
                    } else if ($sheet->getCell('E'.$gob) != ""){
                        $area = $sheet->getCell('D'.$gob);
                        $judul = $sheet->getCell('C'.$gob);
                        $prio = $sheet->getCell('A'.$gob);
                        $pemb = $sheet->getCell('E'.$gob);
                        $tempmake = new TempMake();
                        $tempmake->nim = $nim;
                        $tempmake->nama = $nama;
                        $tempmake->prioritas = $prio;
                        $tempmake->areakeilmuan = $area;
                        $tempmake->calonpembimbing = $pemb;
                        $tempmake->judul = $judul;
                        $tempmake->save();

                    }
                    $gob++;
                    $no =  $sheet->getCell('B'.$gob);
                    if ($no != "" && $no != "-"){
                        $judul = $sheet->getCell('C'.$gob);
                        $prio = $sheet->getCell('A'.$gob);
                        $tempselect = new TempSelect();
                        $tempselect->judul =  $judul;
                        $tempselect->no =  $no;
                        $tempselect->prioritas =  $prio;
                        $tempselect->nim =  $nim;
                        $tempselect->nama =  $nama;
                        $tempselect->save();
                    } else if ($sheet->getCell('E'.$gob) != ""){
                        $area = $sheet->getCell('D'.$gob);
                        $judul = $sheet->getCell('C'.$gob);
                        $prio = $sheet->getCell('A'.$gob);
                        $pemb = $sheet->getCell('E'.$gob);
                        $tempmake = new TempMake();
                        $tempmake->nim = $nim;
                        $tempmake->nama = $nama;
                        $tempmake->prioritas = $prio;
                        $tempmake->areakeilmuan = $area;
                        $tempmake->calonpembimbing = $pemb;
                        $tempmake->judul = $judul;
                        $tempmake->save();

                    }
                    $gob++;
                    $no =  $sheet->getCell('B'.$gob);
                    if ($no != "" && $no != "-"){
                        $judul = $sheet->getCell('C'.$gob);
                        $prio = $sheet->getCell('A'.$gob);
                        $tempselect = new TempSelect();
                        $tempselect->judul =  $judul;
                        $tempselect->no =  $no;
                        $tempselect->prioritas =  $prio;
                        $tempselect->nim =  $nim;
                        $tempselect->nama =  $nama;
                        $tempselect->save();
                    } else if ($sheet->getCell('E'.$gob) != ""){
                        $area = $sheet->getCell('D'.$gob);
                        $judul = $sheet->getCell('C'.$gob);
                        $prio = $sheet->getCell('A'.$gob);
                        $pemb = $sheet->getCell('E'.$gob);
                        $tempmake = new TempMake();
                        $tempmake->nim = $nim;
                        $tempmake->nama = $nama;
                        $tempmake->prioritas = $prio;
                        $tempmake->areakeilmuan = $area;
                        $tempmake->calonpembimbing = $pemb;
                        $tempmake->judul = $judul;
                        $tempmake->save();
                    }
//                    echo $sheet->getCellByColumnAndRow(0,0);
                    //masukin database aja sebagai temp,  delete setiap kali masukin di awal MyModel::truncate();
                    //dua table, satu table yg pertama buat yg ada di daftar, satunya lagi buat yg gda di daftar
                    //grouping dan urutin sesuai nomornya
//                    $cell=$sheet->getCell('A1')->getValue();
                });
            }

            TempGenerate::truncate();
            $listofselect = TempSelect::all();
            $listofmake = TempMake::all();
            $listofdos1 = TopikExcel::select('pembimbing1')->distinct()->get();
            $listofdos2 = TopikExcel::select('pembimbing2')->distinct()->get();
            $listofdos3 = TempMake::select('calonpembimbing')->distinct()->get();

            $dos1 = [];
            foreach ($listofdos1 as $sel) {
                if (!strpos($sel["pembimbing1"], ';')) {
                    $dos1[] = $sel["pembimbing1"];
                }
            }
            $dos2 = [];
            foreach ($listofdos2 as $sel) {
                if (!strpos($sel["pembimbing2"], ';')) {
                    $dos2[] = $sel["pembimbing2"];
                }
            }
            $dos3 = [];
            foreach ($listofdos3 as $sel) {
                $dos3[] = $sel["calonpembimbing"];
//                if (!strpos($sel["calonpembimbing"], ';')) {
//                    $dos3[] = $sel["calonpembimbing"];
//                }
            }
            $arraydos1 = array_unique (array_merge ($dos1, $dos2));
            $arraydos = array_unique(array_merge($arraydos1,$dos3));

//            echo join(',',$arraydos);


            foreach ($listofselect as $sel) {
                $gen = new TempGenerate();
                $topikget = TopikExcel::where('kode', $sel["no"])->get();
//                $mencoba = 0;
//                echo $mencoba;
//                $mencoba++;
                if ($topikget){
                    foreach ($topikget as $sub1) {
                        $gen->prioritas = $sel["prioritas"];
                        $gen->nim = $sel["nim"];
                        $gen->nama = $sel["nama"];
                        $gen->pembimbing1 = $sub1["pembimbing1"];
                        $gen->pembimbing2 = $sub1["pembimbing2"];
                        $gen->judul = $sel["judul"];
                        $gen->save();
                    }
                } else {
                    echo "not found";
                }
//                echo $topikget["pembimbing1"];
//                echo $topikget["pembimbing2"];

            }

            foreach ($listofmake as $sel) {
                $gen = new TempGenerate();
                $gen->prioritas = $sel["prioritas"];
                $gen->nim = $sel["nim"];
                $gen->nama = $sel["nama"];
                $gen->pembimbing1 = $sel["calonpembimbing"];
                $gen->pembimbing2 = " ";
                $gen->judul = $sel["judul"];
                $gen->save();
            }

//            foreach ($arraydos as $item) {
//                echo $item."\n";
//            }
            $file = new Filesystem;
            $file->cleanDirectory(public_path('/public'));
            foreach ($arraydos as $item) {
//                echo $item;
                $allindosen = TempGenerate::where('pembimbing1', 'like' ,'%'.$item.'%')
                    ->orWhere('pembimbing2', 'like' ,'%'.$item.'%')->orderBy('prioritas', 'asc')->orderBy('nim', 'asc')->get();

                if ($allindosen){

                    $tesn = str_replace(";"," ",$item);
                    $tesnama = str_replace("/"," ",$tesn);
                    $file = 'PrioritasTopik/Template.xlsx';
                    $newfile = 'PrioritasTopik/Prioritas_Topik_'.$tesnama.'.xlsx';
                    if (!copy($file, $newfile)) {
                        echo "failed to copy $file...\n";
                    }
                    $number = 1;
                    $start = 15;

                    $this->excel->load($newfile, function ($reader) use ($start,$allindosen,$number,$item) {
//                        $sheet = $reader->getSheet(0); // sheet with name data, but you can also use sheet indexes.

                        $reader->sheet(0, function ($sheet) use($start,$allindosen,$number,$item)
                        {
//                            echo $sheet->getCell('B10');
                            foreach ($allindosen as $genDos){
//                                echo $genDos["judul"];
                                $nomor = 'A'.$start;
                                $tema = 'B'.$start;
                                $calon1 = 'C'.$start;
                                $calon2 = 'D'.$start;
                                $priom = 'E'.$start;
                                $namam = 'F'.$start;
                                $nimm = 'G'.$start;
//                                echo $nomor;
//                                echo $genDos["judul"];
//                                echo $genDos["pembimbing1"];
//                                echo $genDos["nama"];

                                $sheet->setCellValue($nomor,$number);
                                $sheet->setCellValue($tema,$genDos["judul"]);
                                $sheet->getStyle($tema)->getAlignment()->setWrapText(true);
                                $sheet->setCellValue($calon1,$genDos["pembimbing1"]);
                                $sheet->setCellValue($calon2,$genDos["pembimbing2"]);
                                $sheet->setCellValue($priom,$genDos["prioritas"]);
                                $sheet->setCellValue($namam,$genDos["nama"]);
                                $sheet->setCellValue($nimm,$genDos["nim"]);

                                $number++;
                                $start++;
                                //ngisi bagian dlm xlsxnya
//                                echo $item;
//                                echo "\n";
//                                echo $genDos->prioritas;
//                                echo "\n";
                            }
                            $tes = $start-1;
                            $range = "A15:J".$tes;
                            $sheet->setBorder($range, 'thin');

                            $start++;
                            $nimm = 'A'.$start;
                            $sheet->row($start, function($row) { $row->setFontWeight('bold'); });
                            $sheet->setCellValue($nimm,'Jumlah Bimbingan');
                            $start++;
                            $nimm = 'A'.$start;
                            $sheet->cell($nimm)->setFontSize(10);
                            $sheet->setCellValue($nimm,'sebelum ditambah dengan mahasiswa bimbingan baru dari Program Studi Sarjana Teknik Informatika.');
                            $start+=2;
                            $tes = $start+1;
                            $range = "B".$start.":B".$tes;
                            $sheet->cells($range, function($cells) {
                                $cells->setBorder('thick', 'thick', 'thick', 'thick');
                            });
                            $range = "C".$start.":E".$start;
                            $sheet->cells($range, function($cells) {
                                $cells->setBorder('thick', 'thick', 'thick', 'thick');
                            });
                            $range = "F".$start.":F".$tes;
                            $sheet->cells($range, function($cells) {
                                $cells->setBorder('thick', 'thick', 'thick', 'thick');
                            });
                            $tes = $start+1;
                            $sheet->setCellValue("B".$start,'Jumlah Bimbingan');

                            $sheet->setCellValue("F".$start,'Total');
                            $sheet->setCellValue("C".$start,'Strata');
                            $sheet->setCellValue("C".$tes,'S1');
                            $sheet->setCellValue("D".$tes,'S2');
                            $sheet->setCellValue("E".$tes,'S3');


                            $range = "B".$start.":B".$tes;
                            $sheet->mergeCells($range);

                            $range = "F".$start.":F".$tes;
                            $sheet->mergeCells($range);

                            $range = "C".$start.":E".$start;
                            $sheet->mergeCells($range);


                            $sheet->row($start, function($row) { $row->setFontWeight('bold'); });

                            $sheet->row($tes, function($row) { $row->setFontWeight('bold'); });
                            $style = array(
                                'alignment' => array(
                                    'horizontal' => 'center',
                                    'vertical' => 'center'
                                )
                            );
                            $sheet->getStyle("B".$start)->applyFromArray($style);
                            $sheet->getStyle('B'.$start.':F'.$tes)->getAlignment()->applyFromArray(
                                array('horizontal' => 'center',
                                    'vertical' =>'center')
                            );
                            $tes = $start+4;
                            $range = "B".$start.":F".$tes;
                            $sheet->setBorder($range, 'thick');

                            $start+=2;
                            $sheet->setCellValue("B".$start,"Saat Ini  (per wisuda bulan Juli 2017)");
                            $start++;
                            $sheet->setCellValue("B".$start,"Perkiraan Mahasiswa yang  akan Wisuda di Bulan Oktober 2017");
                            $start++;
                            $sheet->setCellValue("B".$start,"Perkiraan  Mahasiswa yang  akan Sidang paling lambat akhir semester 1 2017/2018 (di luar mahasiswa yang akan wisuda Oktober 2017)");
                            $sheet->getStyle('B'.$start)->getAlignment()->setWrapText(true);

                            $start+=2;
                            $sheet->setCellValue("A".$start,"Keterangan Proses Alokasi");
                            $sheet->row($start, function($row) { $row->setFontWeight('bold'); });
                            $start++;
                            $sheet->setCellValue("A".$start,"1");
                            $sheet->setCellValue("B".$start,"Setiap dosen akan dialokasi sejumlah mahasiswa bimbingan, dengan memperhatikan perkiraan jumlah mahasiswa bimbingannya pada Semester I 2018/2019. Kasus-kasus khusus terkait hal ini akan didiskusikan di level prodi.");

                            $start++;
                            $sheet->setCellValue("A".$start,"2");
                            $sheet->setCellValue("B".$start,"Alokasi mahasiswa, pembimbing, dan tema/topik TA akan dilakukan berdasarkan prioritas mahasiswa, prioritas pilihan dosen, dan kapasitas maksimum dosen");

                            $start++;
                            $sheet->setCellValue("A".$start,"3");
                            $sheet->setCellValue("B".$start,"Proses alokasi akan dilakukan oleh Tim TA dengan mempertimbangkan data dari seluruh calon pembimbing.");


                        });
                    })->store('xlsx','public/');
                }
            }

            File::delete(public_path('public/Prioritas_Topik_.xlsx'));
            File::delete(public_path('Prioritas_Topik.zip'));
            $files = glob(public_path('public/*'));
            $zipnew = new Zipper();
            $zipnew->make(public_path('Prioritas_Topik.zip'))->add($files)->close();
            ob_end_clean();
            $headers = array(
                'Content-Type: .zip    application/zip, application/octet-stream',
            );
            return response()->download(public_path('Prioritas_Topik.zip'),'Prioritas_Topik.zip', $headers);
            //bikin zip
            //check dari table yg isinya daftar, urutin sesuai nama dosen
            //masukin tiap nama dosen, ambil dari database
            //generate setelah satu namanya beres
            //ambil excel template, copy, tambahin bagian bawahnya
            //masukin folder
            //zip setelah semuanya jadi
        } else {
            echo 'Upload Failed';
            return back();
        }
        //return download zipnya
    }

    public function topikExcel(Request $request) {
        if ($request->file('excel')->isValid()) {
            TopikExcel::truncate();
                $this->excel->load($request->file('excel'), function ($reader) {
                    $sheet = $reader->getSheet(0); // sheet with name data, but you can also use sheet indexes.
                    $i =  5;
                    while (!($sheet->getCellByColumnAndRow(0,$i)->getValue() == NULL || $sheet->getCellByColumnAndRow(0,$i)->getValue() == '')){
                        $kode = $sheet->getCellByColumnAndRow(0,$i);
                        $pemb1 = $sheet->getCellByColumnAndRow(7,$i);
                        if (empty($pemb1)) {
                            $pemb1 ="";
                        }
                        $pemb2 = $sheet->getCellByColumnAndRow(8,$i);
                        if (empty($pemb2)) {
                            $pemb2 ="";
                        }
                        $top = new TopikExcel();
                        $top->kode = $kode;
                        $top->pembimbing1 = $pemb1;
                        $top->pembimbing2 = $pemb2;
                        $top->save();
                        $i++;
                    }
                    //sel no.20 aneh dia bikin dua pembimbing gitu, carinya berarti substring atau like buat nyocokin nama dosennya
                    echo $sheet->getCellByColumnAndRow(0,0);
                });
        } else {
            echo 'Upload Failed';
        }
        return back();
    }
}
