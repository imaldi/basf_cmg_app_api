<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_work_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('wo_name',255)->nullable()->comment('GS/F/3002-4DEPMMYYXX("GS/F/3002-4=form id",
                //"DEP= abbreviation from each department","MM=month","YY=Year","XX=runing number".');

            $table->unsignedBigInteger('wo_issuer_id')->nullable()->comment('(FK)id karyawan yang submit form work order');
            $table->foreign('wo_issuer_id')->references('id')->on('m_employees');

            $table->unsignedBigInteger('wo_spv_issuer_id')->nullable()->comment('(FK) id karyawan level supervisor yang approve form work order');
            $table->foreign('wo_spv_issuer_id')->references('id')->on('m_employees');
            
            $table->unsignedBigInteger('wo_planner_id')->nullable()->comment('(FK) id karyawan level planner yang approve form work order');
            $table->foreign('wo_planner_id')->references('id')->on('m_employees');

            $table->unsignedBigInteger('wo_pic_id')->nullable()->comment('(FK) id karyawan yang jadi PIC untuk followup form work order');
            $table->foreign('wo_pic_id')->references('id')->on('m_employees');

            $table->unsignedBigInteger('wo_spv_pic_id')->nullable()->comment('(FK) id karyawan yang jadi supervisor PIC form work order');
            $table->foreign('wo_spv_pic_id')->references('id')->on('m_employees');

            $table->timestamp('wo_date_issuer_submit')->nullable()->comment('tanggal issuer submit form work order');
            
            $table->timestamp('wo_date_spv_issuer_approve')->nullable()->comment('tanggal supervisor issuer approve form work order');
            
            $table->timestamp('wo_date_planner_approve')->nullable()->comment('tanggal planner approve form work order');
            
            $table->timestamp('wo_date_pic_plan')->nullable()->comment('tanggal pic submit rencana followup work order');
            
            $table->timestamp('wo_date_spv_pic_approve')->nullable()->comment('tanggal supervisor pic approve form work order');
            
            $table->timestamp('wo_date_pic_finish')->nullable()->comment('tanggal pic submit laporan form work order');
            
            $table->tinyInteger('wo_category')->nullable()->comment('fillable, buat tabel baru 
                //kategori work order("breakdown prod equipment","modifikasi","perbaikan","baru")');
                
            $table->bigInteger('wo_issuer_dept')->nullable()->comment('dapat dari auth resp 
                //Department yang meminta pekerjaan. Join table m_department');
                
            $table->bigInteger('wo_location_id')->nullable()->comment('fillable //join table dari m_location');
            
            $table->string('wo_location_detail',255)->nullable()->comment('Detil lokasi');
            
            $table->string('wo_tag_no',255)->nullable()->comment('tag no');
            
            $table->bigInteger('wo_reffered_dept')->nullable()->comment('where id department //join table dari m_department');
            
            $table->string('wo_reffered_division',255)->nullable()->comment('fillable //Ditujukan ke bagian');
            
            $table->string('wo_description',255)->nullable()->comment('Deskripsi;');
            
            $table->string('wo_issuer_attachment',255)->nullable()->comment('Lampiran oleh Issuer');
            
            $table->bigInteger('wo_c_emergency')->nullable()->comment('//fillable //tabel baru Kedaruratan(
                "1=Keadaan darurat;bahaya keselamatan dengan petensi kerusakan lebih lanjut jika tidak segera diperbaiki",
                "2=Downtime; fasilitas atau peralatan yang tidak menghasilkan pendapatan langsung.",
                "3=Preventive Maintenance","4=Kosmetik"');

            $table->bigInteger('wo_c_ranking_cust')->nullable()->comment('fillable //tabel baru //Ranking Customer(
                "1=Top Management",
                "2=Jalur produksi/transportasi denga implikasi langsung pada pendapatan",
                "3=middle management; Fasilitas yang digunakan banyak orang",
                "4=Fasilitas Lain lain; Fasilitas yang digunakan banyak orang"
                ');
            
            $table->bigInteger('wo_c_equipment_criteria')->nullable()->comment('//fillable //tabel baru  
                //Kriteria Peralatan(
                "1=Utilitas dan sistem keselamatan dengan efek luas",
                "2=Peralatan atau fasilitas utama tanpa cadangan",
                "3=Sebagian besar berdampak pada moral dan produktivitas",
                "4=Penggunaan rendah atau sedikit efek pada output"
                ');

            $table->dateTime('wo_date_recomendation',$precision = 0)->nullable()->comment('//fillable if group = planner //Rekomendasi tanggal pelaksanaan');
            
            $table->dateTime('wo_date_revision',$precision = 0)->nullable()->comment('Tanggal reschedule');
            $table->string('wo_image',255)->nullable()->comment('Gambar oleh issuer');
            $table->string('wo_c_relevant_area',255)->nullable()->comment('Relevant Area ("Plan Produksi","Di Luar Plan Produksi")');
            $table->string('wo_c_cost',255)->nullable()->comment('Alokasi Biaya ("PM=Preventive Maintenance","CM=Corrective Maintenance","PS=Production Support","PC=Plant Changes","MM=Maintenance Mgt."');
            $table->string('wo_pic_action_plan',255)->nullable()->comment('Rencana Kerja PIC');
            $table->string('wo_pic_action',255)->nullable()->comment('Rencana Kerja PIC');
            $table->string('wo_pic_image',255)->nullable()->comment('Gambar oleh PIC');
            $table->dateTime('wo_pic_start_time')->nullable()->comment('Jam Mulai');
            $table->dateTime('wo_pic_finish_time')->nullable()->comment('Jam Selesai');
            $table->string('wo_pic_duration',255)->nullable()->comment('Durasi');
            $table->string('wo_pic_team',255)->nullable()->comment('Dikerjakan oleh');
            $table->string('wo_pic_attachment',255)->nullable()->comment('Lampiran oleh PIC');
            $table->string('wo_reject_reason',255)->nullable()->comment('Alasan jika form ditolak');
            $table->string('wo_hand_over_reason',255)->nullable()->comment('Alasan jika form ditolak');
            $table->tinyInteger('wo_is_open')->nullable()->comment('apakah record work order aktif? 1="open" 0="close"');
            $table->tinyInteger('wo_form_status')->nullable()->comment('status form :
                1.Draft 
                2.Waiting SPV Approval 
                3.Waiting Planner Approval 
                4.Rejected by Spv
                5.Rejected by Planner
                6. Waiting PIC Action Plan
                7. Waitng SPV PIC Approve
                8. In Progress
                9. Completed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_work_orders');
    }
}
