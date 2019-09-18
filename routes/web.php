<?php
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/generate','Generate@index');
Route::post('/generate/input','Generate@input');
Route::post('/generate/topik','Generate@topikExcel');
Route::get('/', 'HomeController@index');

Auth::routes();


Route::get('/edit_profile', 'Profile@index');
Route::post('/save_profile', 'Profile@saveProfile');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/agenda','Agenda@listOfAgenda')->name('agenda');
Route::get('/ta1/pengumuman/{id}','TimTA\TA1\Administrasi\Pengumuman@displayPengumuman');
Route::get('/ta2/pengumuman/{id}', 'TimTA\TA2\Administrasi\Pengumuman@displayPengumuman');


// Redirect ke home tergantung role
Route::get('/{role}', function($role) {
    return redirect('/'.$role.'/home');
});


/* TU Concern */

Route::prefix('tu')->group(function() {
    Route::group(['middleware' => ['role:tu,'.Auth::id()]], function() {
        Route::get('home', 'HomeController@homeTU');

        Route::prefix('pendaftaran')->group(function() {
            Route::get('user', 'TU\PendaftaranMahasiswa@index');
            Route::post('addmahasiswa', 'TU\PendaftaranMahasiswa@addMahasiswa');
            Route::post('batchmahasiswa', 'TU\PendaftaranMahasiswa@batchMahasiswa');
            Route::get('deletemahasiswa/{id}', 'TU\PendaftaranMahasiswa@delete');
            Route::get('showmahasiswa/{id}', 'TU\PendaftaranMahasiswa@show');
            Route::post('updatemahasiswa/{id}', 'TU\PendaftaranMahasiswa@update');

            Route::get('tu', 'TU\PendaftaranTU@index');
            Route::post('addtu', 'TU\PendaftaranTU@addTU');

            Route::get('dosen', 'TU\PendaftaranDosen@index');
            Route::post('adddosen', 'TU\PendaftaranDosen@addDosen');
            Route::get('deletedosen/{id}', 'TU\PendaftaranDosen@delete');
            Route::get('showdosen/{id}', 'TU\PendaftaranDosen@show');
            Route::post('updatedosen/{id}', 'TU\PendaftaranDosen@update');

            Route::get('/tambahtimta/{id}', 'TU\PendaftaranTimTA@tambah');
            Route::get('/hapustimta/{id}', 'TU\PendaftaranTimTA@hapus');


            Route::get('timta', 'TU\PendaftaranTimTA@index');
            Route::post('addtimta', 'TU\PendaftaranTimTA@addTimTA');
            Route::get('deletetimta/{id}', 'TU\PendaftaranTimTA@delete');
            Route::get('showtimta/{id}', 'TU\PendaftaranTimTA@show');
            Route::post('updatetimta/{id}', 'TU\PendaftaranTimTA@update');

            Route::get('ta_1', 'TU\PendaftaranTA@indexTA1');
            Route::post('register_ta1', 'TU\PendaftaranTA@registerTA1');
        });

        Route::prefix('ta1')->group(function() {
            Route::get('home', function() {
                return view ('tu.ta1.home');
            });
            Route::prefix('administrasi')->group(function() {
                Route::get('daftar_progress_summary', 'TU\TA1\Administrasi\ProgressSummary@index');
                Route::get('edit_progress_summary/{id}', 'TU\TA1\Administrasi\ProgressSummary@editIndex');
                Route::get('update_progress_summary/{id}', 'TU\TA1\Administrasi\ProgressSummary@update');
                Route::get('daftar_surat_tugas', 'TU\TA1\Administrasi\SuratTugas@index');
//                Route::post('change_tugas_status', 'TU\TA1\Administrasi\ProgressSummary@changeTugasStatus');
                Route::get('pembuatan_surat_tugas/{id}', 'TU\TA1\Administrasi\SuratTugas@addNewSuratTugasIndex');
                Route::post('save_surat_tugas/{id}', 'TU\TA1\Administrasi\SuratTugas@saveSuratTugas');
                Route::get('cetak_surat_tugas/{id}', 'TU\TA1\Administrasi\SuratTugas@cetakSuratTugas');
                Route::post('finalisasi_seminar', 'TU\TA1\Administrasi\ProgressSummary@finalizeSeminar');
                Route::prefix('a')->group(function() {
                    Route::get('cetak_surat_tugas', 'TU\TA1\Administrasi\SuratTugas@printIndex');
                    Route::post('all_surat_tugas', 'TU\TA1\Administrasi\SuratTugas@printAll');
                });
            });

            Route::prefix('seminar')->group(function() {
                Route::get('seminar', 'TU\TA1\Seminar\Seminar@index');
                Route::post('edit_seminar', 'TU\TA1\Seminar\Seminar@editSeminar');
                Route::get('bap_seminar', 'TU\TA1\Seminar\Seminar@BAPSeminarIndex');
                Route::get('surat_seminar', 'TU\TA1\Seminar\Seminar@suratSeminarIndex');
                Route::post('cetak_surat_seminar', 'TU\TA1\Seminar\Seminar@cetakSuratSeminar');
                Route::get('downloadFormBAP', 'TU\TA1\Seminar\Seminar@downloadFormBAP');
                Route::post('saveBAP', 'TU\TA1\Seminar\Seminar@saveBAP');
                Route::get('downloadBAP/{id}', 'TU\TA1\Seminar\Seminar@downloadBAP');
                Route::get('deleteBAP/{id}', 'TU\TA1\Seminar\Seminar@deleteBAP');
            });
        });

        Route::prefix('ta2')->group(function(){
            Route::get('home', function() {
                return view ('tu.ta2.home');
            });
            Route::prefix('administrasi')->group(function() {
                Route::get('daftar_progress_summary', 'TU\TA2\Administrasi\ProgressSummaryTA2@getAll');
                Route::get('edit_progress_summary/{ps_id}', 'TU\TA2\Administrasi\ProgressSummaryTA2@editProgressSummary');
                Route::post('edit_progress_summary_submit', 'TU\TA2\Administrasi\ProgressSummaryTA2@editProgressSummarySubmit');
                Route::post('finalisasi_ta', 'TU\TA2\Administrasi\ProgressSummaryTA2@finalisasiTA');
                Route::get('pendaftaran', 'TU\TA2\Administrasi\PendaftaranMahasiswa@getMahasiswa');
                Route::post('daftar_ta2', 'TU\TA2\Administrasi\PendaftaranMahasiswa@daftarTA2');
                Route::get('view_riwayat/{ta_id}', 'TU\TA2\Administrasi\Riwayat@index');
                Route::get('unduh_dokumen', 'TU\TA2\Administrasi\UnduhDokumen@index');
                Route::get('downloadFormSeminar', 'TU\TA2\Administrasi\UnduhDokumen@downloadFormSeminar');
                Route::get('downloadFormSidang', 'TU\TA2\Administrasi\UnduhDokumen@downloadFormSidang');
                Route::get('downloadFormPembatalanSidang', 'TU\TA2\Administrasi\UnduhDokumen@downloadFormPembatalanSidang');
            });

            Route::prefix('progress_summary')->group(function() {
                Route::get('all_progress_summary', 'TU\TA2\Administrasi\ProgressSummaryTA2@getAll');
                Route::get('edit_progress_summary/{ps_id}','TU\TA2\Administrasi\ProgressSummaryTA2@editProgressSummary');
                Route::post('edit_progress_summary_submit','TU\TA2\Administrasi\ProgressSummaryTA2@editProgressSummarySubmit');
                Route::post('edit_tugas_submit', 'TU\TA2\Administrasi\ProgressSummaryTA2@editTugasSubmit');
                Route::get('bimbingan/{ta_id}', 'TU\TA2\Administrasi\Bimbingan@index');
                Route::get('review_bimbingan/{bimbingan_id}', 'TU\TA2\Administrasi\Bimbingan@review');
            });

            Route::prefix('seminar')->group(function() {
                Route::get('seminar', 'TU\TA2\Seminar\SeminarTA2@index');
                Route::post('edit_seminar_submit', 'TU\TA2\Seminar\SeminarTA2@editSeminarSubmit');
                Route::get('add_seminar', 'TU\TA2\SeminarTA2@addSeminar');
                Route::post('add_seminar_submit ', 'TU\TA2\Seminar\SeminarTA2@addSeminarSubmit');
                Route::get('lampiran_berita_acara_seminar', 'TU\TA2\Seminar\BeritaAcara@index');
                Route::get('add_lampiran_berita_acara_seminar/{seminar_id}', 'TU\TA2\Seminar\BeritaAcara@editBeritaAcara');
                Route::post('add_lampiran_berita_acara_seminar_submit', 'TU\TA2\Seminar\BeritaAcara@editBeritaAcaraSubmit');
                Route::get('view_lampiran_berita_acara_seminar/{seminar_id}', 'TU\TA2\Seminar\BeritaAcara@viewBeritaAcara');

                //pendaftar
                Route::get('pendaftar', 'TU\TA2\Seminar\Pendaftar@index');

                //individual
                Route::get('edit_seminar_individual/{seminar_id}', 'TU\TA2\Seminar\SeminarTA2@editSeminarIndividual');
                Route::post('edit_seminar_individual_submit', 'TU\TA2\Seminar\SeminarTA2@editSeminarIndividualSubmit');

                //berita acara
                Route::get('download_berita_acara/{berita_acara_id}', 'TU\TA2\Seminar\BeritaAcara@downloadBeritaAcara');
            });

            Route::prefix('sidang')->group(function() {
                Route::get('sidang', 'TU\TA2\Sidang\SidangTA2@index');
                Route::post('add_sidang_submit' ,'TU\TA2\Sidang\SidangTA2@addSidangSubmit');
                Route::get('edit_sidang/{sidang_id}', 'TU\TA2\Sidang\SidangTA2@editSidang');
                Route::post('edit_sidang_submit', 'TU\TA2\Sidang\SidangTA2@editSidangSubmit');
                Route::get('berita_acara_sidang', 'TU\TA2\Sidang\BeritaAcara@index');
                Route::get('add_lampiran_berita_acara_sidang/{sidang_id}', 'TU\TA2\Sidang\BeritaAcara@editBeritaAcara');
                Route::post('add_lampiran_berita_acara_sidang_submit', 'TU\TA2\Sidang\BeritaAcara@editBeritaAcaraSubmit');
                //pendaftar
                Route::get('pendaftar', 'TU\TA2\Sidang\Pendaftar@index');

                //individual
                Route::get('view_berita_acara_individual/{sidang_id}', 'TU\TA2\Sidang\BeritaAcara@viewBeritaAcaraIndividual');
                Route::get('add_berita_acara_individual/{sidang_id}', 'TU\TA2\Sidang\BeritaAcara@addBeritaAcaraIndividual');
                Route::post('add_berita_acara_individual_submit','TU\TA2\Sidang\BeritaAcara@addBeritaAcaraIndividualSubmit');

                //berita acara
                Route::get('download_berita_acara/{bas_id}', 'TU\TA2\Sidang\BeritaAcara@downloadBeritaAcara');
                Route::get('download_lembar_finalisasi/{bas_id}', 'TU\TA2\Sidang\BeritaAcara@downloadLembarFinalisasi');
            });

            Route::prefix('finalisasi')->group(function(){
                Route::get('list_finalisasi', 'TU\TA2\Finalisasi\Finalisasi@index');
            });

            Route::prefix('kelas')->group(function() {
                Route::get('add_kelas', 'TU\TA2\Kelas\KelasTA2@index');
                Route::post('add_new_kelas', 'TU\TA2\Kelas\KelasTA2@addNewKelas');
                Route::post('add_mahasiswa_kelas', 'TU\TA2\Kelas\KelasTA2@addMahasiswa');
                Route::post('add_mahasiswa_batch_kelas', 'TU\TA2\Kelas\KelasTA2@addMahasiswaBatch');
                Route::post('show_mahasiswa_kelas', 'TU\TA2\Kelas\KelasTA2@showMahasiswaKelas');
                Route::get('daftar_kelas', 'TU\TA2\Kelas\KelasTA2@listKelas');
                Route::get('tugas/{tahun}/{semester}', 'TU\TA2\Kelas\Tugas@index');
                Route::get('tugas/{tahun}/{semester}/{tugas_id}', 'TU\TA2\Kelas\Tugas@checklist');
                Route::post('tugas/{tahun}/{semester}/{tugas_id}', 'TU\TA2\Kelas\Tugas@update');
            });

            Route::prefix('history')->group(function() {
            	Route::get('show_history', 'TU\TA2\History\History@index');
            	Route::get('show_progress_summary/{ps_id}', 'TU\TA2\History\History@show');
			});
        });
    });
});

/* Mahasiswa Pages */
Route::prefix('mahasiswa')->group(function() {
    Route::group(['middleware' => ['role:mahasiswa,'.Auth::id()]], function() {
        Route::get('home', 'HomeController@homeMahasiswa');
        Route::prefix('ta1')->group(function() {
            Route::get('home', function() {
                return view ('mahasiswa.ta1.home');
            });
            Route::prefix('administrasi')->group(function() {
                Route::get('topik', 'Mahasiswa\TA1\Administrasi\PemilihanTopik@index');
                Route::post('save_pilihan_topik', 'Mahasiswa\TA1\Administrasi\PemilihanTopik@saveTopic');
                Route::post('usulan_topik', 'Mahasiswa\TA1\Administrasi\PemilihanTopik@addNewTopicProposal');
                Route::get('progress_summary', 'Mahasiswa\TA1\Administrasi\ProgressSummary@index');
                Route::get('downloadBAP/{id}', 'Mahasiswa\TA1\Administrasi\ProgressSummary@downloadBAP');
            });
            Route::prefix('bimbingan')->group(function() {
                Route::get('daftar_bimbingan', 'Mahasiswa\TA1\Bimbingan\Bimbingan@index');
                Route::get('add_bimbingan', 'Mahasiswa\TA1\Bimbingan\Bimbingan@addNewBimbingan');
                Route::post('save_bimbingan', 'Mahasiswa\TA1\Bimbingan\Bimbingan@saveBimbingan');
                Route::post('new_mom', 'Mahasiswa\TA1\Bimbingan\Bimbingan@addNewMoM');
                Route::get('edit_mom', 'Mahasiswa\TA1\Bimbingan\Bimbingan@editMoM');
                Route::get('view_mom', 'Mahasiswa\TA1\Bimbingan\Bimbingan@viewMoM');
                Route::post('update_mom', 'Mahasiswa\TA1\Bimbingan\Bimbingan@updateMoM');
            });
            Route::prefix('seminar')->group(function() {
                Route::get('jadwal_seminar', 'Mahasiswa\TA1\Seminar\Seminar@index');
                Route::post('pendaftaran_seminar', 'Mahasiswa\TA1\Seminar\Seminar@registerSeminar');
                Route::post('update_seminar', 'Mahasiswa\TA1\Seminar\Seminar@updateSeminar');
            });
        });
        Route::prefix('ta2')->group(function() {
            //home
            Route::get('home', 'Mahasiswa\TA2\HomeTA2@index');

            //routing bimbingan
            Route::get('bimbingan', 'Mahasiswa\BimbinganTA2@bimbingan');
            Route::get('add_bimbingan', 'Mahasiswa\BimbinganTA2@addBimbingan');
            Route::post('add_bimbingan_submit', 'Mahasiswa\BimbinganTA2@addBimbinganSubmit');
            Route::get('isi_bimbingan/{bimbingan_id}', 'Mahasiswa\BimbinganTA2@isiBimbingan');
            Route::get('edit_bimbingan/{bimbingan_id}', 'Mahasiswa\BimbinganTA2@editBimbingan');
            Route::post('edit_bimbingan_submit', 'Mahasiswa\BimbinganTA2@editBimbinganSubmit');
            Route::get('delete_bimbingan/{bimbingan_id}', 'Mahasiswa\BimbinganTA2@delete');

            //kelas
            Route::get('kelas', 'Mahasiswa\TA2\KelasTA2@index');
            Route::get('kelas/{tugas_id}/{filename}', 'Mahasiswa\TA2\Tugas@preview');

            //seminar
            Route::get('seminar', 'Mahasiswa\TA2\SeminarTA2@getSeminar');
            Route::post('daftar_seminar', 'Mahasiswa\TA2\ProgressSummaryTA2@daftar_seminar');
            Route::get('view_seminar/{seminar_id}', 'Mahasiswa\TA2\SeminarTA2@viewSeminar');

            //berita acara seminar
            Route::get('lampiran_berita_acara_seminar/{seminar_id}', 'Mahasiswa\TA2\BeritaAcara@getBeritaAcara');
            Route::get('berita_acara/{seminar_id}', 'Mahasiswa\TA2\BeritaAcara@beritaAcara');
            Route::get('download_berita_acara_seminar/{berita_acara_id}', 'Mahasiswa\TA2\BeritaAcara@downloadBeritaAcara');

            //progress summary
            Route::get('view_progress_summary', 'Mahasiswa\TA2\ProgressSummaryTA2@view_progress_summary');

            //sidang
            Route::get('sidang', 'Mahasiswa\TA2\SidangTA2@getSidang');
            Route::post('daftar_sidang', 'Mahasiswa\TA2\ProgressSummaryTA2@daftar_sidang');
            Route::post('rubah_judul', 'Mahasiswa\TA2\ProgressSummaryTA2@rubah_judul');
            Route::get('view_sidang/{sidang_id}', 'Mahasiswa\TA2\SidangTA2@viewSidang');

            //berita acara sidang
            Route::get('view_berita_acara_individual/{sidang_id}', 'Mahasiswa\TA2\SidangTA2@viewBeritaAcaraIndividual');
            Route::get('download_berita_acara/{berita_acara_id}', 'Mahasiswa\TA2\SidangTA2@downloadBeritaAcara');
            Route::get('download_lembar_finalisasi/{berita_acara_id}', 'Mahasiswa\TA2\SidangTA2@downloadLembarFinalisasi');

            //riwayat
            Route::get('view_riwayat/{ta_id}', 'Mahasiswa\TA2\Riwayat@index');
        });
    });
});


/* Dosen Concern */
Route::prefix('dosen')->group(function() {
    Route::group(['middleware' => ['role:dosen,'.Auth::id()]], function() {
        Route::get('home', 'HomeController@homeDosen');
        Route::prefix('ta1')->group(function() {
            Route::get('home', function() {
                return view ('dosen.ta1.home');
            });
            Route::get('/topik', 'Topik@index');
            Route::post('/addtopik', 'Topik@addTopik');

            Route::get('/addtopik', 'Topik@allTopik');

            Route::get('/alltopik', 'Topik@allTopik');


            Route::get('/topikdosen', 'Topik@allTopiknormal');

            Route::get('/alltopikdosen', 'Topik@allTopikdosen');
            Route::get('/generate', 'Topik@generateExcel');


            Route::post('/lengkapi_topik', 'Topik@postTopic');
            Route::post('/terima_topik', 'Topik@finalTopic');

            Route::get('/lengkapi_topik', 'HomeController@homeDosen');
            Route::get('/terima_topik', 'HomeController@homeDosen');

            Route::post('/hapus_topik', 'Topik@deleteTopic');
            Route::post('/increase_topic_quota', 'Topik@increaseTopicQuota');
            Route::post('/decrease_topic_quota', 'Topik@decreaseTopicQuota');
            Route::get('/read/{id}', 'Topik@readTopic');
            Route::post('/edit_topik', 'Topik@processEditTopic');
            Route::post('/copy_topik', 'Topik@copyTopic');
            Route::post('/submit_topik', 'Topik@submitTopic');
            Route::post('/edit_topik/process', 'Topik@editTopic');

            Route::get('/hapus_topik', 'HomeController@homeDosen');
            Route::get('/increase_topic_quota', 'HomeController@homeDosen');
            Route::get('/decrease_topic_quota', 'HomeController@homeDosen');
            Route::get('/edit_topik', 'HomeController@homeDosen');
            Route::get('/copy_topik', 'HomeController@homeDosen');
            Route::get('/submit_topik', 'HomeController@homeDosen');
            Route::get('/edit_topik/process', 'HomeController@homeDosen');

            Route::prefix('administrasi')->group(function() {
                Route::get('pengajuan_topik', 'Dosen\TA1\Administrasi\PengajuanTopik@index');
                Route::post('add_new_topic', 'Dosen\TA1\Administrasi\PengajuanTopik@addNewTopic');
                Route::post('buka_topik', 'Dosen\TA1\Administrasi\PengajuanTopik@openTopic');
                Route::post('tutup_topik', 'Dosen\TA1\Administrasi\PengajuanTopik@closeTopic');
                Route::post('hapus_topik', 'Dosen\TA1\Administrasi\PengajuanTopik@deleteTopic');
                Route::post('increase_topic_quota', 'Dosen\TA1\Administrasi\PengajuanTopik@increaseTopicQuota');
                Route::post('decrease_topic_quota', 'Dosen\TA1\Administrasi\PengajuanTopik@decreaseTopicQuota');
                Route::get('pemilihan_mahasiswa_bimbingan', 'Dosen\TA1\Administrasi\PemilihanMahasiswaBimbingan@index');
                Route::post('save_mahasiswa_bimbingan', 'Dosen\TA1\Administrasi\PemilihanMahasiswaBimbingan@saveMahasiswaBimbingan');
                Route::post('delete_mahasiswa_bimbingan', 'Dosen\TA1\Administrasi\PemilihanMahasiswaBimbingan@deleteMahasiswaBimbingan');
                Route::get('progress_summary', 'Dosen\TA1\Administrasi\ProgressSummaryMahasiswa@index');
                Route::get('detail_progress_summary', 'Dosen\TA1\Administrasi\ProgressSummaryMahasiswa@detail');
                Route::get('downloadBAP/{id}', 'Dosen\TA1\Administrasi\ProgressSummaryMahasiswa@downloadBAP');
            });

            Route::prefix('bimbingan')->group(function() {
                Route::get('daftar_topik_bimbingan', 'Dosen\TA1\Bimbingan\Bimbingan@index');
                Route::get('perkembangan_bimbingan/{ta_id}', 'Dosen\TA1\Bimbingan\Bimbingan@progressBimbingan');
                Route::get('edit_mom_bimbingan', 'Dosen\TA1\Bimbingan\Bimbingan@editMoMBimbingan');
                Route::get('view_mom_bimbingan', 'Dosen\TA1\Bimbingan\Bimbingan@viewMoMBimbingan');
                Route::post('update_mom_bimbingan','Dosen\TA1\Bimbingan\Bimbingan@updateMoMBimbingan');
            });

            Route::prefix('seminar')->group(function() {
                Route::get('jadwal_seminar_penguji', 'Dosen\TA1\Seminar\Seminar@schedulePenguji');
                Route::get('jadwal_seminar_pembimbing', 'Dosen\TA1\Seminar\Seminar@schedulePembimbing');
                Route::post('edit_jadwal_seminar', 'Dosen\TA1\Seminar\Seminar@editSeminarSchedule');
            });
        });
        Route::prefix('ta2')->group(function() {
            Route::get('home', function() {
                return view('dosen.ta2.home');
            });

            Route::prefix('bimbingan')->group(function() {
               Route::get('mahasiswa','Dosen\TA2\Bimbingan\MahasiswaBimbingan@index');
               Route::get('approve/{nim_mahasiswa}','Dosen\TA2\Bimbingan\Approve@index');
               Route::get('review_bimbingan/{nim}', 'Dosen\TA2\Bimbingan\Approve@review');
               Route::get('approve_bimbingan/{nim}', 'Dosen\TA2\Bimbingan\Approve@approved');
            });

            Route::prefix('seminar')->group(function(){
                Route::get('list_seminar', 'Dosen\TA2\Seminar\SeminarTA2@getPendingSeminars');
                Route::get('lampiran_berita_acara_seminar', 'Dosen\TA2\Seminar\BeritaAcara@index');
                Route::get('seminar_done', 'Dosen\TA2\Seminar\SeminarTA2@getFinishedSeminars');
                Route::post('edit_seminar_submit', 'Dosen\TA2\Seminar\SeminarTA2@editSeminarSubmit');
                Route::get('add_lampiran_berita_acara_seminar/{seminar_id}', 'Dosen\TA2\Seminar\BeritaAcara@editBeritaAcara');
                Route::post('add_lampiran_berita_acara_seminar_submit', 'Dosen\TA2\Seminar\BeritaAcara@editBeritaAcaraSubmit');

                //berita acara
                Route::get('view_berita_acara/{seminar_id}', 'Dosen\TA2\Seminar\BeritaAcara@viewBeritaAcara');
                Route::get('download_berita_acara/{berita_acara_id}', 'Dosen\TA2\Seminar\BeritaAcara@downloadBeritaAcara');

                //individual
                Route::get('edit_seminar_individual/{seminar_id}', 'Dosen\TA2\Seminar\SeminarTA2@editSeminarIndividual');
                Route::post('edit_seminar_individual_submit', 'Dosen\TA2\Seminar\SeminarTA2@editSeminarIndividualSubmit');
            });

            Route::prefix('sidang')->group(function(){
                //dosen pembimbing
                Route::get('list_sidang', 'Dosen\TA2\Sidang\SidangTA2@getPendingSidang');
                Route::get('sidang', 'Dosen\TA2\Sidang\SidangTA2@index');
                Route::post('add_sidang_submit' ,'Dosen\TA2\Sidang\SidangTA2@addSidangSubmit');
                Route::get('edit_sidang/{sidang_id}', 'Dosen\TA2\Sidang\SidangTA2@editSidang');
                Route::post('edit_sidang_submit', 'Dosen\TA2\Sidang\SidangTA2@editSidangSubmit');

                //dosen penguji
                Route::get('sidang_penguji', 'Dosen\TA2\Sidang\SidangPengujiTA2@index');
                Route::get('view_sidang_penguji/{sidang_id}', 'Dosen\TA2\Sidang\SidangPengujiTA2@view');
                Route::post('sidang_penguji_submit', 'Dosen\TA2\Sidang\SidangPengujiTA2@submit');

                //berita acara
                Route::get('view_berita_acara_individual/{sidang_id}', 'Dosen\TA2\Sidang\BeritaAcara@viewBeritaAcaraIndividual');
                Route::get('download_berita_acara/{berita_acara_id}', 'Dosen\TA2\Sidang\BeritaAcara@downloadBeritaAcara');
                Route::get('download_lembar_finalisasi/{berita_acara_id}', 'Dosen\TA2\Sidang\BeritaAcara@downloadLembarFinalisasi');
            });

            Route::prefix('progress_summary')->group(function(){
                Route::get('list_progress_summary', 'Dosen\TA2\ProgressSummaryTA2@index');
                Route::get('view_progress_summary/{ps_id}', 'Dosen\TA2\ProgressSummaryTA2@view_progress_summary');
                Route::get('view_riwayat/{ta_id}', 'Dosen\TA2\Riwayat@index');
            });

			Route::prefix('history')->group(function() {
				Route::get('show_history', 'Dosen\TA2\History\History@index');
				Route::get('show_progress_summary/{ps_id}', 'Dosen\TA2\History\History@show');
			});

			Route::get('kelas/{tugas_id}/{filename}', 'Dosen\TA2\Tugas@preview');
        });
    });
});

// Tim TA Concern
Route::prefix('tim_ta')->group(function() {
    Route::group(['middleware' => ['role:tim_ta,'. Auth::id()]], function() {
        Route::get('home', 'HomeController@homeTimTA');
        Route::get('tahun_ajaran', 'TimTA\TahunAjaran@index');
        Route::post('add_tahun_ajaran', 'TimTA\TahunAjaran@addNewTahunAjaran');
        Route::get('edit_tahun_ajaran/{id}', 'TimTA\TahunAjaran@editTahunAjaran');
        Route::post('update_tahun_ajaran', 'TimTA\TahunAjaran@updateTahunAjaran');
        Route::get('agenda', 'Agenda@index');
        Route::post('add_agenda', 'Agenda@addAgenda');
        Route::get('delete_agenda/{id}', 'Agenda@deleteAgenda');


        Route::prefix('ta1')->group(function() {
            Route::get('home', function() {
                return view ('tim_ta.ta1.home');
            });
            Route::prefix('administrasi')->group(function() {
                Route::get('daftar_progress_summary', 'TimTA\TA1\Administrasi\ProgressSummary@index');
                Route::get('edit_progress_summary/{id}', 'TimTA\TA1\Administrasi\ProgressSummary@editIndex');
                Route::get('update_progress_summary/{id}', 'TimTA\TA1\Administrasi\ProgressSummary@update');
                Route::post('change_tugas_status', 'TU\TA1\Administrasi\ProgressSummary@changeTugasStatus');

                Route::get('daftar_topik', 'TimTA\TA1\Administrasi\Topik@index');
                Route::get('pengumuman_umum', 'TimTA\TA1\Administrasi\Pengumuman@index');
                Route::post('add_pengumuman', 'TimTA\TA1\Administrasi\Pengumuman@addNewPengumuman');
                Route::post('delete_pengumuman', 'TimTA\TA1\Administrasi\Pengumuman@deletePengumuman');
                Route::get('daftar_mahasiswa_bimbingan', 'TimTA\TA1\Administrasi\MahasiswaBimbingan@index');
                Route::post('set_ta_topic', 'TimTA\TA1\Administrasi\MahasiswaBimbingan@setTATopic');
                Route::post('finalisasi_mahasiswa_bimbingan', 'TimTA\TA1\Administrasi\MahasiswaBimbingan@finalize');
                Route::get('nilai_akhir', 'TimTA\TA1\Administrasi\NilaiAkhir@index');
                Route::post('finalisasi_nilai_akhir', 'TimTA\TA1\Administrasi\NilaiAkhir@finalize');

                Route::get('tugas', 'TimTA\TA1\Administrasi\Tugas@index');
                Route::post('add_new_tugas', 'TimTA\TA1\Administrasi\Tugas@addNewTugas');
                Route::post('delete_tugas', 'TimTA\TA1\Administrasi\Tugas@deleteTugas');

                Route::get('history', 'TimTA\TA1\Administrasi\History@index');
                Route::get('history_detail/{tahun_ajaran_id}', 'TimTA\TA1\Administrasi\History@indexDetail');
            });

            Route::prefix('seminar')->group(function() {
                Route::get('jadwal_seminar', 'TimTA\TA1\Seminar\Seminar@index');
                Route::post('edit_seminar', 'TimTA\TA1\Seminar\Seminar@editSeminar');
            });
        });

        Route::prefix('ta2')->group(function() {
            Route::get('home', function() {
                return view ('tim_ta.ta2.home');
            });
            Route::prefix('administrasi')->group(function() {
                Route::get('daftar_progress_summary', 'TimTA\TA2\Administrasi\ProgressSummaryTA2@getAll');
                Route::get('edit_progress_summary/{ps_id}', 'TimTA\TA2\Administrasi\ProgressSummaryTA2@editProgressSummary');
                Route::post('edit_progress_summary_submit', 'TimTA\TA2\Administrasi\ProgressSummaryTA2@editProgressSummarySubmit');
				Route::get('bimbingan/{ta_id}', 'TimTA\TA2\Administrasi\Bimbingan@index');
				Route::get('review_bimbingan/{bimbingan_id}', 'TimTA\TA2\Administrasi\Bimbingan@review');
            });

            Route::prefix('seminar')->group(function() {
                Route::get('seminar', 'TimTA\TA2\Seminar\SeminarTA2@index');
                Route::post('edit_seminar_submit', 'TimTA\TA2\Seminar\SeminarTA2@editSeminarSubmit');
                Route::get('add_seminar', 'TimTA\TA2\SeminarTA2@addSeminar');
                Route::post('add_seminar_submit ', 'TimTA\TA2\Seminar\SeminarTA2@addSeminarSubmit');
                Route::get('lampiran_berita_acara_seminar', 'TimTA\TA2\Seminar\BeritaAcara@index');
                Route::get('add_lampiran_berita_acara_seminar/{seminar_id}', 'TimTA\TA2\Seminar\BeritaAcara@editBeritaAcara');
                Route::post('add_lampiran_berita_acara_seminar_submit', 'TimTA\TA2\Seminar\BeritaAcara@editBeritaAcaraSubmit');
                Route::get('view_lampiran_berita_acara_seminar/{seminar_id}', 'TimTA\TA2\Seminar\BeritaAcara@viewBeritaAcara');

                //pendaftar
                Route::get('pendaftar', 'TimTA\TA2\Seminar\Pendaftar@index');

                //individual
                Route::get('edit_seminar_individual/{seminar_id}', 'TimTA\TA2\Seminar\SeminarTA2@editSeminarIndividual');
                Route::post('edit_seminar_individual_submit', 'TimTA\TA2\Seminar\SeminarTA2@editSeminarIndividualSubmit');
                Route::get('view_berita_acara_individual/{seminar_id}', 'TimTA\TA2\Seminar\BeritaAcara@viewBeritaAcaraIndividual');
                Route::get('download_berita_acara/{berita_acara_id}', 'TimTA\TA2\Seminar\BeritaAcara@downloadBeritaAcara');
            });

            Route::prefix('sidang')->group(function() {
                Route::get('jadwal_sidang', 'TimTA\TA2\Sidang\Sidang@index');
                Route::get('list_sidang','TimTA\TA2\Sidang\Sidang@listSidang');
                Route::get('edit_sidang/{sidang_id}', 'TimTA\TA2\Sidang\Sidang@editSidang');
                Route::post('edit_sidang_submit', 'TimTA\TA2\Sidang\Sidang@edit_sidang_submit');

                Route::get('list_berita_acara','TimTA\TA2\Sidang\BeritaAcara@index');
                Route::get('view_lampiran_berita_acara_sidang/{bas_id}','TimTA\TA2\Sidang\BeritaAcara@view');
                Route::post('kelulusan_submit', 'TimTA\TA2\Sidang\BeritaAcara@kelulusan_submit');

                //pendaftar
                Route::get('pendaftar', 'TimTa\TA2\Sidang\Pendaftar@index');

                //individual
                Route::get('edit_sidang_individual/{sidang_id}', 'TimTA\TA2\Sidang\Sidang@editSidangIndividual');
                Route::post('edit_sidang_individual_submit', 'TimTA\TA2\Sidang\Sidang@editSidangIndividualSubmit');

                //berita acara
                Route::get('view_berita_acara/{sidang_id}', 'TimTA\TA2\Sidang\BeritaAcara@viewBeritaAcara');
                Route::post('view_berita_acara_submit', 'TimTA\TA2\Sidang\BeritaAcara@viewBeritaAcaraSubmit');
                Route::get('view_berita_acara_final/{sidang_id}', 'TimTA\TA2\Sidang\BeritaAcara@viewBeritaAcaraFinal');
                Route::get('download_berita_acara/{berita_acara_id}', 'TimTA\TA2\Sidang\BeritaAcara@downloadBeritaAcara');
                Route::get('download_lembar_finalisasi/{berita_acara_id}', 'TimTA\TA2\Sidang\BeritaAcara@downloadLembarFinalisasi');
            });

            Route::prefix('kelas')->group(function() {
                Route::get('daftar_kelas', 'TimTA\TA2\Kelas\Kelas@index');
                Route::get('tugas/{tahun}/{semester}', 'TimTA\TA2\Kelas\Kelas@tugas');
                Route::post('tugas/{tahun}/{semester}', 'TimTA\TA2\Kelas\Kelas@upload');
                Route::get('tugas/{tahun}/{semester}/{tugas_id}/{filename}', 'TimTA\TA2\Kelas\Kelas@preview');
            });

            Route::prefix('administrasi')->group(function() {
            	Route::get('pengumuman_umum', 'TimTA\TA2\Administrasi\Pengumuman@index');
				Route::post('add_pengumuman', 'TimTA\TA2\Administrasi\Pengumuman@addNewPengumuman');
				Route::post('delete_pengumuman', 'TimTA\TA2\Administrasi\Pengumuman@deletePengumuman');
                Route::get('view_riwayat/{ta_id}', 'TimTA\TA2\Administrasi\Riwayat@index');
			});

			Route::prefix('history')->group(function() {
				Route::get('show_history', 'TimTA\TA2\History\History@index');
				Route::get('show_progress_summary/{ps_id}', 'TimTA\TA2\History\History@show');
			});
        });
    });
});