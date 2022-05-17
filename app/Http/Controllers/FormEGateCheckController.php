<?php

namespace App\Http\Controllers;

use App\Models\FormEGateCheck;
use App\Models\TruckRent;
use App\Http\Resources\FormEGateResource;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Models\employee_has_groups;
use App\Mail\FormEGateCheckMail;


class FormEGateCheckController extends Controller
{
    public function viewAllEgateForm(Request $request)
    {
        $gateableType = $request->query('gateableType');
        $queryString = $request->query('queryString');

        if ($gateableType != null) {
            $formsWithoutQuery_Builder =
                FormEGateCheck::

                // Urutan bener2 ngaruh di query,
                where('gate_is_out', 0)->where('gate_report_status', 0)

                // ->whereNotIn('gate_kesimpulan', [1])
                // ->orWhereNull('gate_kesimpulan')

                ->where(function ($query) use ($gateableType) {
                    $query
                        ->with('gateable_type', 'LIKE', '%' . $gateableType . '%')
                        ->orWhereNull('gateable_type');
                })->whereNotIn('gate_kesimpulan', [1])
                // ->orWhereNull('gate_kesimpulan')

                // //   ->orderBy('gateable_type')
                ->orderBy('id', 'DESC');
                // ->get();
            // // $forms->where('gateable_type', 'LIKE', 'FormLoadingTexN701S')->all();
            // $forms->whereNotNull('gateable_type')->all();
        } else {
            $formsWithoutQuery_Builder =
                FormEGateCheck::where('gate_is_out', 0)->where('gate_report_status', 0)
                // ->orderBy('gateable_type')
                ->orderBy('id', 'DESC');
                // ->get();
        }

        if($queryString != null || $queryString != ""){
            $formsWithQuery_Builder = $formsWithoutQuery_Builder->where(function ($query) use ($queryString) {
                $query
                    ->where('gate_jenis_kendaraan', 'LIKE', '%' . $queryString . '%');
            });
            $forms = $formsWithQuery_Builder->get();
        } else {
            $forms = $formsWithoutQuery_Builder->get();
        }
        // $resourceList =
        //     FormEGateResource::collection($forms);
        // $sortedResourceList = $resourceList->sortBy('gate_loading_status');
        return response()->json([
            'code' => 200,
            'message' => 'Success Fetch Data',
            'data' =>
            // $gateableType
            FormEGateResource::collection($forms)
            // $sortedResourceList->values()->all()
        ], 200);
    }

    public function getDaftarNamaAngkutanEgateForm(Request $request)
    {
        $listAngkutan = TruckRent::where('tr_status', 1)->get();

        return response()->json([
            'code' => 200,
            'message' => 'Success Fetch Data',
            'data' =>
            // $gateableType
            $listAngkutan
        ], 200);
    }

    // public function viewAllEgateFormWithType($type){
    //     $forms =
    //     FormEGateCheck::where("gateable_id",0)->get();

    //     return response()->json([
    //         'code' => 200,
    //         'message' => 'Success Fetch Data',
    //         'data' =>
    //             FormEGateResource::collection($forms)
    //         ], 200);
    // }

    public function getOneEgateForm($id)
    {
        try {
            $gateForm = FormEGateCheck::findOrFail($id);


            return response()->json([
                'code' => 200,
                'message' => 'Success Fetch Data',
                'data' => [new FormEGateResource($gateForm)]
                // [$gateForm]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
            ], 404);
        }
    }
    public function createOrUpdateEgateForm(Request $request)
    {
        $this->validate($request, [
            // 'form_id' => 'integer',
            // ini nilai nya apa saja
            'gate_report_status' => ['integer', Rule::in(['0', '1']),],
            'gate_is_in' => ['integer', Rule::in(['0', '1']),],
            'gate_is_out' => ['integer', Rule::in(['0', '1']),],
            'gate_formulir_sopir_telp_darurat' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kondisi_cukup_istirahat' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kondisi_tidak_pengaruh_obat_alkohol' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_APD' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_traffic_tool' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_senter' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kotak_p3k' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_pemadam_kebakaran' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_spill_kit' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_b_sarung_tangan' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_b_respirator' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_b_plakat_tanda_bahaya' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_b_battery_breaker' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_b_hazard' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_kemudi_rem_berfungsi' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_sabuk_pengaman_berfungsi' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_lampu_nyala' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_kaca' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_ban' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_ban_not_vulkanisir' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_dongkrak_toolkit' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_tutup_tangki' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_chasis' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_tutup_cairan_aki' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_twist_lock' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_landing_leg' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_kontainer' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_valve' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_cleanliness_certificate' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_oli_tidak_bocor' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_kend_tachograph' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_pintu_kanan' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_pintu_kiri' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_tdk_ada_benda_asing_laci_dashboard' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_tdk_ada_benda_asing_diatas_dashboard' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_tdk_ada_benda_asing_dicelah_kursi' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_tdk_ada_benda_asing_dibawah_kursi' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_tdk_ada_benda_asing_dibelakang_kursi' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_bagian_atap_rapi_tdk_ada_benda_asing' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_is_approve' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_email_sent' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_exit_dokumen_pengantar_barang_lengkap' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_exit_muatan_disegel' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_exit_tidak_tercecer' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_exit_petunjuk_darurat_transportasi' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_tipe_pelanggan' => ['integer', Rule::in(['1', '2', '3']),],
            'gate_exit_plakat_tanda_bahaya_terpasang' => ['integer', Rule::in(['0', '1', '2']),],
            // 'gate_loading_status' => ['integer',Rule::in(['0','1','2']),],
            'gate_pengganjal_roda' => ['integer', Rule::in(['0', '1', '2']),],
            'gateable_id' => 'integer',
            'gate_kesimpulan' => ['integer', Rule::in(['0', '1', '2']),],
            'gate_check_out_employee_id_mobile' => 'integer',



            'gate_report_code' => 'string|max:255',
            'gate_pengganjal_roda_desc' => 'string|max:255',
            'gate_formulir_sopir_telp_darurat_desc' => 'string|max:255',
            'gate_kondisi_cukup_istirahat_desc' => 'string|max:255',
            'gate_kondisi_tidak_pengaruh_obat_alkohol_desc' => 'string|max:255',
            'gate_APD_desc' => 'string|max:255',
            'gate_traffic_tool_desc' => 'string|max:255',
            'gate_senter_desc' => 'string|max:255',
            'gate_kotak_p3k_desc' => 'string|max:255',
            'gate_pemadam_kebakaran_desc' => 'string|max:255',
            'gate_spill_kit_desc' => 'string|max:255',
            'gate_sarung_tangan_desc' => 'string|max:255',
            'gate_respirator_desc' => 'string|max:255',
            'gate_plakat_tanda_bahaya_desc' => 'string|max:255',
            'gate_battery_breaker_desc' => 'string|max:255',
            'gate_hazard_desc' => 'string|max:255',
            'gate_kend_kemudi_rem_berfungsi_desc' => 'string|max:255',
            'gate_kend_sabuk_pengaman_berfungsi_desc' => 'string|max:255',
            'gate_kend_lampu_nyala_desc' => 'string|max:255',
            'gate_kend_kaca_desc' => 'string|max:255',
            'gate_kend_ban_desc' => 'string|max:255',
            'gate_kend_dongkrak_toolkit_desc' => 'string|max:255',
            'gate_kend_tutup_tangki_desc' => 'string|max:255',
            'gate_kend_tutup_cairan_aki_desc' => 'string|max:255',
            'gate_kend_chasis_desc' => 'string|max:255',
            'gate_kend_twist_lock_desc' => 'string|max:255',
            'gate_kend_landing_leg_desc' => 'string|max:255',
            'gate_kend_kontainer_desc' => 'string|max:255',
            'gate_kend_valve_desc' => 'string|max:255',
            'gate_kend_cleanliness_certificate_desc' => 'string|max:255',
            'gate_kend_oli_tidak_bocor_desc' => 'string|max:255',
            'gate_kend_tachograph_desc' => 'string|max:255',
            'gate_pintu_kanan_desc' => 'string|max:255',
            'gate_pintu_kiri_desc' => 'string|max:255',
            'gate_tdk_ada_benda_asing_laci_dashboard_desc' => 'string|max:255',
            'gate_tdk_ada_benda_asing_diatas_dashboard_desc' => 'string|max:255',
            'gate_tdk_ada_benda_asing_dicelah_kursi_desc' => 'string|max:255',
            'gate_tdk_ada_benda_asing_dibawah_kursi_desc' => 'string|max:255',
            'gate_tdk_ada_benda_asing_dibelakang_kursi_desc' => 'string|max:255',
            'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc' => 'string|max:255',
            'gate_bagian_atap_rapi_tdk_ada_benda_asing_desc' => 'string|max:255',
            'gate_not_approve_reason' => 'string|max:255',
            'gate_exit_dokumen_pengantar_barang_lengkap_desc' => 'string|max:255',
            'gate_exit_muatan_disegel_desc' => 'string|max:255',
            'gate_exit_tidak_tercecer_desc' => 'string|max:255',
            'gate_exit_petunjuk_darurat_transportasi_desc' => 'string|max:255',
            'gate_exit_plakat_tanda_bahaya_terpasang_desc' => 'string|max:255',
            'gate_delete_reason' => 'string|max:255',
            'gate_approve_admin_message' => 'string|max:255',
            // 'gate_signature_employee_check_in' => 'string',
            // 'gate_signature_driver_check_in' => 'string',
            // 'gate_signature_employee_check_out' => 'string',
            // 'gate_signature_driver_check_out' => 'string',
            'gate_nama_angkutan' => 'string|max:255',
            'gate_nomor_plat' => 'string|max:255',
            'gate_nomor_tangki' => 'string|max:255',
            'gate_nomor_JO_DO' => 'string|max:255',
            'gate_nama_driver' => 'string|max:255',
            'gate_nomor_telp' => 'string|max:255',
            'gate_jenis_sim' => 'string|max:255',
            'gate_nomor_sim' => 'string|max:255',
            'gate_nama_produk' => 'string|max:255',
            'gate_nama_perusahaan' => 'string|max:255',
            'gate_jenis_kendaraan' => 'string|max:255',
            'gate_loading_type' => 'string|max:255',
            'rk_masa_berlaku_SIM' => 'date',
            'rk_masa_berlaku_STNK' => 'date',
            'gate_masa_berlaku_kir' => 'date',
            'gate_loading_date' => 'date',

            // 'gate_signature_employee_check_in' => 'file',
            // 'gate_signature_driver_check_in' => 'file',
            // 'gate_signature_employee_check_out' => 'file',
            // 'gate_signature_driver_check_out' => 'file',
            'gateable_type' => 'string',
        ]);
        if ((int) $request->input('form_id') != null || (int) $request->input('form_id') != 0) {
            try {
                $formEGate = FormEGateCheck::findOrFail((int) $request->input('form_id'));

                if ((int) $request->input('gate_is_out') != null || (int) $request->input('gate_is_out') != 0) {

                    $formEGate->update([
                        'gate_is_in' => 1,
                        'gate_is_out' => (int) $request->input('gate_is_out'),
                        'gate_exit_dokumen_pengantar_barang_lengkap' => (int) $request->input('gate_exit_dokumen_pengantar_barang_lengkap'),
                        'gate_exit_muatan_disegel' => (int) $request->input('gate_exit_muatan_disegel'),
                        'gate_exit_tidak_tercecer' => (int) $request->input('gate_exit_tidak_tercecer'),
                        'gate_exit_petunjuk_darurat_transportasi' => (int) $request->input('gate_exit_petunjuk_darurat_transportasi'),
                        'gate_exit_plakat_tanda_bahaya_terpasang' => (int) $request->input('gate_exit_plakat_tanda_bahaya_terpasang'),
                        'gate_exit_dokumen_pengantar_barang_lengkap_desc' => $request->input('gate_exit_dokumen_pengantar_barang_lengkap_desc'),
                        'gate_exit_muatan_disegel_desc' => $request->input('gate_exit_muatan_disegel_desc'),
                        'gate_exit_tidak_tercecer_desc' => $request->input('gate_exit_tidak_tercecer_desc'),
                        'gate_exit_petunjuk_darurat_transportasi_desc' => $request->input('gate_exit_petunjuk_darurat_transportasi_desc'),
                        'gate_exit_plakat_tanda_bahaya_terpasang' => (int) $request->input('gate_exit_plakat_tanda_bahaya_terpasang'),
                        'gate_exit_plakat_tanda_bahaya_terpasang_desc' => $request->input('gate_exit_plakat_tanda_bahaya_terpasang_desc'),
                        'gate_exit_date' => $request->input('gate_exit_date'),
                    ]);
                } else {
                    $formEGate->update([
                        'gate_report_status' => (int) $request->input('gate_report_status'),
                        'gate_is_in' => (int) $request->input('gate_is_in'),
                        'gate_is_out' => (int) $request->input('gate_is_out'),
                        'gate_formulir_sopir_telp_darurat' => (int) $request->input('gate_formulir_sopir_telp_darurat'),
                        'gate_kondisi_cukup_istirahat' => (int) $request->input('gate_kondisi_cukup_istirahat'),
                        'gate_kondisi_tidak_pengaruh_obat_alkohol' => (int) $request->input('gate_kondisi_tidak_pengaruh_obat_alkohol'),
                        'gate_APD' => (int) $request->input('gate_APD'),
                        'gate_traffic_tool' => (int) $request->input('gate_traffic_tool'),
                        'gate_senter' => (int) $request->input('gate_senter'),
                        'gate_kotak_p3k' => (int) $request->input('gate_kotak_p3k'),
                        'gate_pemadam_kebakaran' => (int) $request->input('gate_pemadam_kebakaran'),
                        'gate_spill_kit' => (int) $request->input('gate_spill_kit'),
                        'gate_b_sarung_tangan' => (int) $request->input('gate_b_sarung_tangan'),
                        'gate_b_respirator' => (int) $request->input('gate_b_respirator'),
                        'gate_b_plakat_tanda_bahaya' => (int) $request->input('gate_b_plakat_tanda_bahaya'),
                        'gate_b_battery_breaker' => (int) $request->input('gate_b_battery_breaker'),
                        'gate_b_hazard' => (int) $request->input('gate_b_hazard'),
                        'gate_kend_kemudi_rem_berfungsi' => (int) $request->input('gate_kend_kemudi_rem_berfungsi'),
                        'gate_kend_sabuk_pengaman_berfungsi' => (int) $request->input('gate_kend_sabuk_pengaman_berfungsi'),
                        'gate_kend_lampu_nyala' => (int) $request->input('gate_kend_lampu_nyala'),
                        'gate_kend_kaca' => (int) $request->input('gate_kend_kaca'),
                        'gate_kend_ban' => (int) $request->input('gate_kend_ban'),
                        'gate_kend_ban_not_vulkanisir' => (int) $request->input('gate_kend_ban_not_vulkanisir'),
                        'gate_kend_dongkrak_toolkit' => (int) $request->input('gate_kend_dongkrak_toolkit'),
                        'gate_kend_tutup_tangki' => (int) $request->input('gate_kend_tutup_tangki'),
                        'gate_kend_chasis' => (int) $request->input('gate_kend_chasis'),
                        'gate_kend_tutup_cairan_aki' => (int) $request->input('gate_kend_tutup_cairan_aki'),
                        'gate_kend_twist_lock' => (int) $request->input('gate_kend_twist_lock'),
                        'gate_kend_landing_leg' => (int) $request->input('gate_kend_landing_leg'),
                        'gate_kend_kontainer' => (int) $request->input('gate_kend_kontainer'),
                        'gate_kend_valve' => (int) $request->input('gate_kend_valve'),
                        'gate_kend_cleanliness_certificate' => (int) $request->input('gate_kend_cleanliness_certificate'),
                        'gate_kend_oli_tidak_bocor' => (int) $request->input('gate_kend_oli_tidak_bocor'),
                        'gate_kend_tachograph' => (int) $request->input('gate_kend_tachograph'),
                        'gate_pintu_kanan' => (int) $request->input('gate_pintu_kanan'),
                        'gate_pintu_kiri' => (int) $request->input('gate_pintu_kiri'),
                        'gate_tdk_ada_benda_asing_laci_dashboard' => (int) $request->input('gate_tdk_ada_benda_asing_laci_dashboard'),
                        'gate_tdk_ada_benda_asing_diatas_dashboard' => (int) $request->input('gate_tdk_ada_benda_asing_diatas_dashboard'),
                        'gate_tdk_ada_benda_asing_dicelah_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dicelah_kursi'),
                        'gate_tdk_ada_benda_asing_dibawah_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dibawah_kursi'),
                        'gate_tdk_ada_benda_asing_dibelakang_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dibelakang_kursi'),
                        'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu' => (int) $request->input('gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu'),
                        'gate_bagian_atap_rapi_tdk_ada_benda_asing' => (int) $request->input('gate_bagian_atap_rapi_tdk_ada_benda_asing'),
                        'gate_is_approve' => (int) $request->input('gate_is_approve'),
                        'gate_email_sent' => (int) $request->input('gate_email_sent'),
                        'gate_pengganjal_roda' => (int) $request->input('gate_pengganjal_roda'),
                        'gate_check_out_employee_id_mobile' => (int) $request->input('gate_check_out_employee_id_mobile'),

                        'gate_pengganjal_roda_desc' => $request->input('gate_pengganjal_roda_desc'),
                        'gate_report_code' => $request->input('gate_report_code'),
                        'gate_formulir_sopir_telp_darurat_desc' => $request->input('gate_formulir_sopir_telp_darurat_desc'),
                        'gate_kondisi_cukup_istirahat_desc' => $request->input('gate_kondisi_cukup_istirahat_desc'),
                        'gate_kondisi_tidak_pengaruh_obat_alkohol_desc' => $request->input('gate_kondisi_tidak_pengaruh_obat_alkohol_desc'),
                        'gate_APD_desc' => $request->input('gate_APD_desc'),
                        'gate_traffic_tool_desc' => $request->input('gate_traffic_tool_desc'),
                        'gate_senter_desc' => $request->input('gate_senter_desc'),
                        'gate_kotak_p3k_desc' => $request->input('gate_kotak_p3k_desc'),
                        'gate_pemadam_kebakaran_desc' => $request->input('gate_pemadam_kebakaran_desc'),
                        'gate_spill_kit_desc' => $request->input('gate_spill_kit_desc'),
                        'gate_sarung_tangan_desc' => $request->input('gate_sarung_tangan_desc'),
                        'gate_respirator_desc' => $request->input('gate_respirator_desc'),
                        'gate_plakat_tanda_bahaya_desc' => $request->input('gate_plakat_tanda_bahaya_desc'),
                        'gate_battery_breaker_desc' => $request->input('gate_battery_breaker_desc'),
                        'gate_hazard_desc' => $request->input('gate_hazard_desc'),
                        'gate_kend_kemudi_rem_berfungsi_desc' => $request->input('gate_kend_kemudi_rem_berfungsi_desc'),
                        'gate_kend_sabuk_pengaman_berfungsi_desc' => $request->input('gate_kend_sabuk_pengaman_berfungsi_desc'),
                        'gate_kend_lampu_nyala_desc' => $request->input('gate_kend_lampu_nyala_desc'),
                        'gate_kend_kaca_desc' => $request->input('gate_kend_kaca_desc'),
                        'gate_kend_ban_desc' => $request->input('gate_kend_ban_desc'),
                        'gate_kend_dongkrak_toolkit_desc' => $request->input('gate_kend_dongkrak_toolkit_desc'),
                        'gate_kend_tutup_tangki_desc' => $request->input('gate_kend_tutup_tangki_desc'),
                        'gate_kend_tutup_cairan_aki_desc' => $request->input('gate_kend_tutup_cairan_aki_desc'),
                        'gate_kend_chasis_desc' => $request->input('gate_kend_chasis_desc'),
                        'gate_kend_twist_lock_desc' => $request->input('gate_kend_twist_lock_desc'),
                        'gate_kend_landing_leg_desc' => $request->input('gate_kend_landing_leg_desc'),
                        'gate_kend_kontainer_desc' => $request->input('gate_kend_kontainer_desc'),
                        'gate_kend_valve_desc' => $request->input('gate_kend_valve_desc'),
                        'gate_kend_cleanliness_certificate_desc' => $request->input('gate_kend_cleanliness_certificate_desc'),
                        'gate_kend_oli_tidak_bocor_desc' => $request->input('gate_kend_oli_tidak_bocor_desc'),
                        'gate_kend_tachograph_desc' => $request->input('gate_kend_tachograph_desc'),
                        'gate_pintu_kanan_desc' => $request->input('gate_pintu_kanan_desc'),
                        'gate_pintu_kiri_desc' => $request->input('gate_pintu_kiri_desc'),
                        'gate_tdk_ada_benda_asing_laci_dashboard_desc' => $request->input('gate_tdk_ada_benda_asing_laci_dashboard_desc'),
                        'gate_tdk_ada_benda_asing_diatas_dashboard_desc' => $request->input('gate_tdk_ada_benda_asing_diatas_dashboard_desc'),
                        'gate_tdk_ada_benda_asing_dicelah_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dicelah_kursi_desc'),
                        'gate_tdk_ada_benda_asing_dibawah_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dibawah_kursi_desc'),
                        'gate_tdk_ada_benda_asing_dibelakang_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dibelakang_kursi_desc'),
                        'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc' => $request->input('gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc'),
                        'gate_bagian_atap_rapi_tdk_ada_benda_asing_desc' => $request->input('gate_bagian_atap_rapi_tdk_ada_benda_asing_desc'),
                        'gate_not_approve_reason' => $request->input('gate_not_approve_reason'),
                        'gate_delete_reason' => $request->input('gate_delete_reason'),
                        'gate_approve_admin_message' => $request->input('gate_approve_admin_message'),
                        'gate_kesimpulan' => (int) $request->input('gate_kesimpulan'),
                        'gate_nama_angkutan' => $request->input('gate_nama_angkutan'),
                        'gate_nomor_plat' => $request->input('gate_nomor_plat'),
                        'gate_nomor_tangki' => $request->input('gate_nomor_tangki'),
                        'gate_nomor_JO_DO' => $request->input('gate_nomor_JO_DO'),
                        'gate_nama_driver' => $request->input('gate_nama_driver'),
                        'gate_nomor_telp' => $request->input('gate_nomor_telp'),
                        'gate_jenis_sim' => $request->input('gate_jenis_sim'),
                        'gate_nomor_sim' => $request->input('gate_nomor_sim'),
                        'gate_nama_produk' => $request->input('gate_nama_produk'),
                        'gate_nama_perusahaan' => $request->input('gate_nama_perusahaan'),
                        'gate_jenis_kendaraan' => $request->input('gate_jenis_kendaraan'),
                        'gate_loading_type' => $request->input('gate_loading_type'),
                        'rk_masa_berlaku_SIM' => $request->input('rk_masa_berlaku_SIM'),
                        'rk_masa_berlaku_STNK' => $request->input('rk_masa_berlaku_STNK'),
                        'gate_masa_berlaku_kir' => $request->input('gate_masa_berlaku_kir'),
                        'gate_loading_date' => $request->input('gate_loading_date'),
                        // 'gate_signature_employee_check_in' => $request->input('gate_signature_employee_check_in'),
                        // 'gate_signature_driver_check_in' => $request->input('gate_signature_driver_check_in'),
                        // 'gate_signature_employee_check_out' => $request->input('gate_signature_employee_check_out'),
                        // 'gate_signature_driver_check_out' => $request->input('gate_signature_driver_check_out'),
                    ]);

                    if($request->input('gate_kesimpulan') == 1){

                        $transporter = TruckRent::where('tr_name',$request->input('gate_nama_angkutan'))->first();
                        $emailReceiver = array();
                        // dd($formEGate->id);
                        // input transporter email into array
                        if($transporter->tr_email_1){
                            $emailReceiver[] = $transporter->tr_email_1;
                        }
                        if($transporter->tr_email_2){
                            $emailReceiver[] = $transporter->tr_email_2;
                        }
                        if($transporter->tr_email_3){
                            $emailReceiver[] = $transporter->tr_email_3;
                        }
                        if($transporter->tr_email_4){
                            $emailReceiver[] = $transporter->tr_email_4;
                        }
                        if($transporter->tr_email_5){
                            $emailReceiver[] = $transporter->tr_email_5;
                        }
                        // get user who has "Gate check ditolak" role
                        $userIsReceiver = employee_has_groups::where('role_id',24)->get();
                        $userIsReceiverArray = array();
                        foreach($userIsReceiver as $receiver){
                            $userIsReceiverArray[] = $receiver->model_id;
                        }
                        $userReceiverList = User::whereIn('id', $userIsReceiverArray)->get();
                        foreach($userReceiverList as $receiver){
                            if($receiver->emp_email){
                                $emailReceiver[] = $receiver->emp_email;
                            }
                        }
        
                        $employee = Auth::user();
                        $request->emp_name = $employee->emp_name;
                        $request->form_id = $formEGate->id;
        
                        Mail::to('yanedgroup@gmail.com')->send(new FormEGateCheckMail($request));
                        foreach($emailReceiver as $mail){
                            Mail::to($mail)->send(new FormEGateCheckMail($request));
                        }
                    }
                }


                // TODO nanti usahakan bisa
                // if(((int) $request->input('gate_check_out_employee_id_mobile')) == 1){
                //     $employee = Auth::user();
                //     $user = User::find($employee->id);
                //     $user->save();

                //     $user->formEGateCheckCheckOutEmployee()->save($formEGate);

                // }

                if ($request->file('gate_pic_1')) {
                    $file_pic_1 = 'uploads/form_e_gate/' . $formEGate->gate_pic_1;
                    if (is_file($file_pic_1)) {
                        unlink(public_path($file_pic_1));
                    }
                    $name_pic_1 = time() . 'gate_pic_1.png';
                    $request->file('gate_pic_1')->move('uploads/form_e_gate', $name_pic_1);
                    $formEGate->update(
                        [
                            'gate_pic_1' => $name_pic_1,
                        ]
                    );
                }
                if ($request->file('gate_pic_2')) {
                    $file_pic_2 = 'uploads/form_e_gate/' . $formEGate->gate_pic_2;
                    if (is_file($file_pic_2)) {
                        unlink(public_path($file_pic_2));
                    }
                    $name_pic_2 = time() . $request->file('gate_pic_2')->getClientOriginalName();
                    $request->file('gate_pic_2')->move('uploads/form_e_gate', $name_pic_2);
                    $formEGate->update(
                        [
                            'gate_pic_2' => $name_pic_2,
                        ]
                    );
                }
                if ($request->file('gate_pic_3')) {
                    $file_pic_3 = 'uploads/form_e_gate/' . $formEGate->gate_pic_3;
                    if (is_file($file_pic_3)) {
                        unlink(public_path($file_pic_3));
                    }
                    $name_pic_3 = time() . $request->file('gate_pic_3')->getClientOriginalName();
                    $request->file('gate_pic_3')->move('uploads/form_e_gate', $name_pic_3);
                    $formEGate->update(
                        [
                            'gate_pic_3' => $name_pic_3,
                        ]
                    );
                }
                if ($request->file('gate_pic_4')) {
                    $file_pic_4 = 'uploads/form_e_gate/' . $formEGate->gate_pic_4;
                    if (is_file($file_pic_4)) {
                        unlink(public_path($file_pic_4));
                    }
                    $name_pic_4 = time() . $request->file('gate_pic_4')->getClientOriginalName();
                    $request->file('gate_pic_4')->move('uploads/form_e_gate', $name_pic_4);
                    $formEGate->update(
                        [
                            'gate_pic_4' => $name_pic_4,
                        ]
                    );
                }
                if ($request->file('gate_pic_5')) {
                    $file_pic_5 = 'uploads/form_e_gate/' . $formEGate->gate_pic_5;
                    if (is_file($file_pic_5)) {
                        unlink(public_path($file_pic_5));
                    }
                    $name_pic_5 = time() . $request->file('gate_pic_5')->getClientOriginalName();
                    $request->file('gate_pic_5')->move('uploads/form_e_gate', $name_pic_5);
                    $formEGate->update(
                        [
                            'gate_pic_5' => $name_pic_5,
                        ]
                    );
                }
                // Tanda tangan checkin
                if ($request->input('gate_signature_employee_check_in')) {
                    $decodedDocs = base64_decode($request->input('gate_signature_employee_check_in'));
                    $name = time() . "_gate_signature_employee_check_in.png";
                    file_put_contents('uploads/form_e_gate/signatures/' . $name, $decodedDocs);


                    $formEGate->update(
                        [
                            'gate_signature_employee_check_in' => $name,
                        ]
                    );
                }

                //versi base 64
                if ($request->input('gate_signature_driver_check_in')) {
                    $decodedDocs = base64_decode($request->input('gate_signature_driver_check_in'));
                    $name = time() . "_gate_signature_driver_check_in.png";
                    file_put_contents('uploads/form_e_gate/signatures/' . $name, $decodedDocs);


                    $formEGate->update(
                        [
                            'gate_signature_driver_check_in' => $name,
                        ]
                    );
                }
                // end ttd checkin
                if ($request->input('gate_is_out') == 1) {
                    //versi base 64
                    if ($request->input('gate_signature_employee_check_out')) {
                        $decodedDocs = base64_decode($request->input('gate_signature_employee_check_out'));
                        $name = time() . "_gate_signature_employee_check_out.png";
                        file_put_contents('uploads/form_e_gate/signatures/' . $name, $decodedDocs);


                        $formEGate->update(
                            [
                                'gate_signature_employee_check_out' => $name,
                            ]
                        );
                    }




                    //versi file
                    // if($request->file('gate_signature_employee_check_out')){
                    //     $file = 'uploads/attendance/signatures/'.$form->att_trainer_signature;

                    //     if (is_file($file)) {
                    //         unlink(public_path($file));
                    //     }
                    //     $name = time()."_gate_signature_employee_check_out.png";
                    //     $request->file('gate_signature_driver_check_out')->move('uploads/form_e_gate/signatures',$name);

                    //     $formEGate->update(
                    //         [
                    //             'gate_signature_employee_check_out' => $name,
                    //             ]
                    //         );

                    // }
                    //versi base 64
                    if ($request->input('gate_signature_driver_check_out')) {
                        $decodedDocs = base64_decode($request->input('gate_signature_driver_check_out'));
                        $name = time() . "gate_signature_driver_check_out.png";
                        file_put_contents('uploads/form_e_gate/signatures/' . $name, $decodedDocs);
                    }

                    //     $formEGate->update(
                    //         [
                    //             'gate_loading_status' => (int) FormEGateCheck::returnEgateStatus($formEGate),
                    // 'gate_is_editable'=> (int) FormEGateCheck::
                    // returnIsEditable($formEGate),

                    //             ]
                    //         );
                    //versi file
                    // if($request->file('gate_signature_driver_check_out')){
                    //     // $file = 'uploads/attendance/signatures/'.$form->att_trainer_signature;

                    //     // if (is_file($file)) {
                    //     //     unlink(public_path($file));
                    //     // }
                    //     $name = time()."_gate_signature_driver_check_out.png";
                    //     $request->file('gate_signature_driver_check_out')->move('uploads/form_e_gate/signatures',$name);



                    //     $formEGate->update(
                    //         [
                    //             'gate_signature_driver_check_out' => $name,
                    //             ]
                    //         );

                    // }
                    
                }

                

                return response()->json([
                    'code' => 200,
                    'message' => 'Success Update Data',
                    'data' =>
                    // $request->input('gate_signature_employee_check_out')
                    [new FormEGateResource($formEGate)]
                    // [$formEGate]
                ], 200);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Given E Gate Form ID not found',
                    'data' => []
                ], 404);
            }
        } else {
            $employee = Auth::user();

            $formEGate = FormEGateCheck::create(
                [
                    'user_id' => $employee->id,
                    'gate_report_status' => (int) $request->input('gate_report_status'),
                    'gate_is_in' => 1,
                    'gate_is_out' => (int) $request->input('gate_is_out'),
                    'gate_formulir_sopir_telp_darurat' => (int) $request->input('gate_formulir_sopir_telp_darurat'),
                    'gate_kondisi_cukup_istirahat' => (int) $request->input('gate_kondisi_cukup_istirahat'),
                    'gate_kondisi_tidak_pengaruh_obat_alkohol' => (int) $request->input('gate_kondisi_tidak_pengaruh_obat_alkohol'),
                    'gate_APD' => (int) $request->input('gate_APD'),
                    'gate_traffic_tool' => (int) $request->input('gate_traffic_tool'),
                    'gate_senter' => (int) $request->input('gate_senter'),
                    'gate_kotak_p3k' => (int) $request->input('gate_kotak_p3k'),
                    'gate_pemadam_kebakaran' => (int) $request->input('gate_pemadam_kebakaran'),
                    'gate_spill_kit' => (int) $request->input('gate_spill_kit'),
                    'gate_b_sarung_tangan' => (int) $request->input('gate_b_sarung_tangan'),
                    'gate_b_respirator' => (int) $request->input('gate_b_respirator'),
                    'gate_b_plakat_tanda_bahaya' => (int) $request->input('gate_b_plakat_tanda_bahaya'),
                    'gate_b_battery_breaker' => (int) $request->input('gate_b_battery_breaker'),
                    'gate_b_hazard' => (int) $request->input('gate_b_hazard'),
                    'gate_kend_kemudi_rem_berfungsi' => (int) $request->input('gate_kend_kemudi_rem_berfungsi'),
                    'gate_kend_sabuk_pengaman_berfungsi' => (int) $request->input('gate_kend_sabuk_pengaman_berfungsi'),
                    'gate_kend_lampu_nyala' => (int) $request->input('gate_kend_lampu_nyala'),
                    'gate_kend_kaca' => (int) $request->input('gate_kend_kaca'),
                    'gate_kend_ban' => (int) $request->input('gate_kend_ban'),
                    'gate_kend_ban_not_vulkanisir' => (int) $request->input('gate_kend_ban_not_vulkanisir'),
                    'gate_kend_dongkrak_toolkit' => (int) $request->input('gate_kend_dongkrak_toolkit'),
                    'gate_kend_tutup_tangki' => (int) $request->input('gate_kend_tutup_tangki'),
                    'gate_kend_chasis' => (int) $request->input('gate_kend_chasis'),
                    'gate_kend_tutup_cairan_aki' => (int) $request->input('gate_kend_tutup_cairan_aki'),
                    'gate_kend_twist_lock' => (int) $request->input('gate_kend_twist_lock'),
                    'gate_kend_landing_leg' => (int) $request->input('gate_kend_landing_leg'),
                    'gate_kend_kontainer' => (int) $request->input('gate_kend_kontainer'),
                    'gate_kend_valve' => (int) $request->input('gate_kend_valve'),
                    'gate_kend_cleanliness_certificate' => (int) $request->input('gate_kend_cleanliness_certificate'),
                    'gate_kend_oli_tidak_bocor' => (int) $request->input('gate_kend_oli_tidak_bocor'),
                    'gate_kend_tachograph' => (int) $request->input('gate_kend_tachograph'),
                    'gate_pintu_kanan' => (int) $request->input('gate_pintu_kanan'),
                    'gate_pintu_kiri' => (int) $request->input('gate_pintu_kiri'),
                    'gate_tdk_ada_benda_asing_laci_dashboard' => (int) $request->input('gate_tdk_ada_benda_asing_laci_dashboard'),
                    'gate_tdk_ada_benda_asing_diatas_dashboard' => (int) $request->input('gate_tdk_ada_benda_asing_diatas_dashboard'),
                    'gate_tdk_ada_benda_asing_dicelah_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dicelah_kursi'),
                    'gate_tdk_ada_benda_asing_dibawah_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dibawah_kursi'),
                    'gate_tdk_ada_benda_asing_dibelakang_kursi' => (int) $request->input('gate_tdk_ada_benda_asing_dibelakang_kursi'),
                    'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu' => (int) $request->input('gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu'),
                    'gate_bagian_atap_rapi_tdk_ada_benda_asing' => (int) $request->input('gate_bagian_atap_rapi_tdk_ada_benda_asing'),
                    'gate_is_approve' => (int) $request->input('gate_is_approve'),
                    'gate_email_sent' => (int) $request->input('gate_email_sent'),
                    'gate_tipe_pelanggan' => (int) $request->input('gate_tipe_pelanggan'),
                    'gate_loading_status' => 0,
                    'gate_is_editable' => 0,
                    'gate_pengganjal_roda' => (int) $request->input('gate_pengganjal_roda'),

                    'gate_pengganjal_roda_desc' => $request->input('gate_pengganjal_roda_desc'),
                    'gate_report_code' => $request->input('gate_report_code'),
                    'gate_formulir_sopir_telp_darurat_desc' => $request->input('gate_formulir_sopir_telp_darurat_desc'),
                    'gate_kondisi_cukup_istirahat_desc' => $request->input('gate_kondisi_cukup_istirahat_desc'),
                    'gate_kondisi_tidak_pengaruh_obat_alkohol_desc' => $request->input('gate_kondisi_tidak_pengaruh_obat_alkohol_desc'),
                    'gate_APD_desc' => $request->input('gate_APD_desc'),
                    'gate_traffic_tool_desc' => $request->input('gate_traffic_tool_desc'),
                    'gate_senter_desc' => $request->input('gate_senter_desc'),
                    'gate_kotak_p3k_desc' => $request->input('gate_kotak_p3k_desc'),
                    'gate_pemadam_kebakaran_desc' => $request->input('gate_pemadam_kebakaran_desc'),
                    'gate_spill_kit_desc' => $request->input('gate_spill_kit_desc'),
                    'gate_sarung_tangan_desc' => $request->input('gate_sarung_tangan_desc'),
                    'gate_respirator_desc' => $request->input('gate_respirator_desc'),
                    'gate_plakat_tanda_bahaya_desc' => $request->input('gate_plakat_tanda_bahaya_desc'),
                    'gate_battery_breaker_desc' => $request->input('gate_battery_breaker_desc'),
                    'gate_hazard_desc' => $request->input('gate_hazard_desc'),
                    'gate_kend_kemudi_rem_berfungsi_desc' => $request->input('gate_kend_kemudi_rem_berfungsi_desc'),
                    'gate_kend_sabuk_pengaman_berfungsi_desc' => $request->input('gate_kend_sabuk_pengaman_berfungsi_desc'),
                    'gate_kend_lampu_nyala_desc' => $request->input('gate_kend_lampu_nyala_desc'),
                    'gate_kend_kaca_desc' => $request->input('gate_kend_kaca_desc'),
                    'gate_kend_ban_desc' => $request->input('gate_kend_ban_desc'),
                    'gate_kend_dongkrak_toolkit_desc' => $request->input('gate_kend_dongkrak_toolkit_desc'),
                    'gate_kend_tutup_tangki_desc' => $request->input('gate_kend_tutup_tangki_desc'),
                    'gate_kend_tutup_cairan_aki_desc' => $request->input('gate_kend_tutup_cairan_aki_desc'),
                    'gate_kend_chasis_desc' => $request->input('gate_kend_chasis_desc'),
                    'gate_kend_twist_lock_desc' => $request->input('gate_kend_twist_lock_desc'),
                    'gate_kend_landing_leg_desc' => $request->input('gate_kend_landing_leg_desc'),
                    'gate_kend_kontainer_desc' => $request->input('gate_kend_kontainer_desc'),
                    'gate_kend_valve_desc' => $request->input('gate_kend_valve_desc'),
                    'gate_kend_cleanliness_certificate_desc' => $request->input('gate_kend_cleanliness_certificate_desc'),
                    'gate_kend_oli_tidak_bocor_desc' => $request->input('gate_kend_oli_tidak_bocor_desc'),
                    'gate_kend_tachograph_desc' => $request->input('gate_kend_tachograph_desc'),
                    'gate_pintu_kanan_desc' => $request->input('gate_pintu_kanan_desc'),
                    'gate_pintu_kiri_desc' => $request->input('gate_pintu_kiri_desc'),
                    'gate_tdk_ada_benda_asing_laci_dashboard_desc' => $request->input('gate_tdk_ada_benda_asing_laci_dashboard_desc'),
                    'gate_tdk_ada_benda_asing_diatas_dashboard_desc' => $request->input('gate_tdk_ada_benda_asing_diatas_dashboard_desc'),
                    'gate_tdk_ada_benda_asing_dicelah_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dicelah_kursi_desc'),
                    'gate_tdk_ada_benda_asing_dibawah_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dibawah_kursi_desc'),
                    'gate_tdk_ada_benda_asing_dibelakang_kursi_desc' => $request->input('gate_tdk_ada_benda_asing_dibelakang_kursi_desc'),
                    'gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc' => $request->input('gate_tdk_ada_bagian_dilas_utk_penyimpanan_sesuatu_desc'),
                    'gate_bagian_atap_rapi_tdk_ada_benda_asing_desc' => $request->input('gate_bagian_atap_rapi_tdk_ada_benda_asing_desc'),
                    'gate_not_approve_reason' => $request->input('gate_not_approve_reason'),
                    'gate_delete_reason' => $request->input('gate_delete_reason'),
                    'gate_approve_admin_message' => $request->input('gate_approve_admin_message'),

                    'gate_kesimpulan' => (int) $request->input('gate_kesimpulan'),
                    'gate_nama_angkutan' => $request->input('gate_nama_angkutan'),
                    'gate_nomor_plat' => $request->input('gate_nomor_plat'),
                    'gate_nomor_tangki' => $request->input('gate_nomor_tangki'),
                    'gate_nomor_JO_DO' => $request->input('gate_nomor_JO_DO'),
                    'gate_nama_driver' => $request->input('gate_nama_driver'),
                    'gate_nomor_telp' => $request->input('gate_nomor_telp'),
                    'gate_jenis_sim' => $request->input('gate_jenis_sim'),
                    'gate_nomor_sim' => $request->input('gate_nomor_sim'),
                    'gate_nama_produk' => $request->input('gate_nama_produk'),
                    'gate_nama_perusahaan' => $request->input('gate_nama_perusahaan'),
                    'gate_jenis_kendaraan' => $request->input('gate_jenis_kendaraan'),
                    'gate_loading_type' => $request->input('gate_loading_type'),
                    'rk_masa_berlaku_SIM' => $request->input('rk_masa_berlaku_SIM'),
                    'rk_masa_berlaku_STNK' => $request->input('rk_masa_berlaku_STNK'),
                    'gate_masa_berlaku_kir' => $request->input('gate_masa_berlaku_kir'),
                    'gate_loading_date' => $request->input('gate_loading_date'),
                    'gate_checkin_date' => $request->input('gate_checkin_date'),
                ]

                
            );

            if($request->input('gate_kesimpulan') == 1){

                $transporter = TruckRent::where('tr_name',$request->input('gate_nama_angkutan'))->first();
                $emailReceiver = array();
                // dd($formEGate->id);
                // input transporter email into array
                if($transporter->tr_email_1){
                    $emailReceiver[] = $transporter->tr_email_1;
                }
                if($transporter->tr_email_2){
                    $emailReceiver[] = $transporter->tr_email_2;
                }
                if($transporter->tr_email_3){
                    $emailReceiver[] = $transporter->tr_email_3;
                }
                if($transporter->tr_email_4){
                    $emailReceiver[] = $transporter->tr_email_4;
                }
                if($transporter->tr_email_5){
                    $emailReceiver[] = $transporter->tr_email_5;
                }
                // get user who has "Gate check ditolak" role
                $userIsReceiver = employee_has_groups::where('role_id',24)->get();
                $userIsReceiverArray = array();
                foreach($userIsReceiver as $receiver){
                    $userIsReceiverArray[] = $receiver->model_id;
                }
                $userReceiverList = User::whereIn('id', $userIsReceiverArray)->get();
                foreach($userReceiverList as $receiver){
                    if($receiver->emp_email){
                        $emailReceiver[] = $receiver->emp_email;
                    }
                }

                $employee = Auth::user();
                $request->emp_name = $employee->emp_name;
                $request->form_id = $formEGate->id;

                Mail::to('yanedgroup@gmail.com')->send(new FormEGateCheckMail($request));
                foreach($emailReceiver as $mail){
                    Mail::to($mail)->send(new FormEGateCheckMail($request));
                }
            }

            if ($request->file('gate_pic_1')) {
                $file_pic_1 = 'uploads/form_e_gate/' . $formEGate->gate_pic_1;
                if (is_file($file_pic_1)) {
                    unlink(public_path($file_pic_1));
                }
                $name_pic_1 = time() . '_gate_pic_1.png';
                $request->file('gate_pic_1')->move('uploads/form_e_gate', $name_pic_1);
                $formEGate->update(
                    [
                        'gate_pic_1' => $name_pic_1,
                    ]
                );
            }
            if ($request->file('gate_pic_2')) {
                $file_pic_2 = 'uploads/form_e_gate/' . $formEGate->gate_pic_2;
                if (is_file($file_pic_2)) {
                    unlink(public_path($file_pic_2));
                }
                $name_pic_2 = time() . '_gate_pic_2.png';
                $request->file('gate_pic_2')->move('uploads/form_e_gate', $name_pic_2);
                $formEGate->update(
                    [
                        'gate_pic_2' => $name_pic_2,
                    ]
                );
            }
            if ($request->file('gate_pic_3')) {
                $file_pic_3 = 'uploads/form_e_gate/' . $formEGate->gate_pic_3;
                if (is_file($file_pic_3)) {
                    unlink(public_path($file_pic_3));
                }
                $name_pic_3 = time() . '_gate_pic_3.png';
                $request->file('gate_pic_3')->move('uploads/form_e_gate', $name_pic_3);
                $formEGate->update(
                    [
                        'gate_pic_3' => $name_pic_3,
                    ]
                );
            }
            if ($request->file('gate_pic_4')) {
                $file_pic_4 = 'uploads/form_e_gate/' . $formEGate->gate_pic_4;
                if (is_file($file_pic_4)) {
                    unlink(public_path($file_pic_4));
                }
                $name_pic_4 = time() . '_gate_pic_4.png';
                $request->file('gate_pic_4')->move('uploads/form_e_gate', $name_pic_4);
                $formEGate->update(
                    [
                        'gate_pic_4' => $name_pic_4,
                    ]
                );
            }
            if ($request->file('gate_pic_5')) {
                $file_pic_5 = 'uploads/form_e_gate/' . $formEGate->gate_pic_5;
                if (is_file($file_pic_5)) {
                    unlink(public_path($file_pic_5));
                }
                $name_pic_5 = time() . '_gate_pic_5.png';
                $request->file('gate_pic_5')->move('uploads/form_e_gate', $name_pic_5);
                $formEGate->update(
                    [
                        'gate_pic_5' => $name_pic_5,
                    ]
                );
            }

            //versi base 64
            if ($request->input('gate_signature_employee_check_in')) {
                $decodedDocs = base64_decode($request->input('gate_signature_employee_check_in'));
                $name = time() . "_gate_signature_employee_check_in.png";
                file_put_contents('uploads/form_e_gate/signatures/' . $name, $decodedDocs);


                $formEGate->update(
                    [
                        'gate_signature_employee_check_in' => $name,
                    ]
                );
            }
            //versi file
            // if($request->file('gate_signature_employee_check_in')){
            //     // $file = 'uploads/attendance/signatures/'.$formEGate->gate_signature_employee_check_in;

            //     // if (is_file($file)) {
            //     //     unlink(public_path($file));
            //     // }
            //     $name = time()."_gate_signature_employee_check_in.png";

            //     $request->file('gate_signature_employee_check_in')->move('uploads/form_e_gate/signatures',$name);

            //     $formEGate->update(
            //         [
            //             'gate_signature_employee_check_in' => $name,
            //             ]
            //         );

            // }

            //versi base 64
            if ($request->input('gate_signature_driver_check_in')) {
                $decodedDocs = base64_decode($request->input('gate_signature_driver_check_in'));
                $name = time() . "_gate_signature_driver_check_in.png";
                file_put_contents('uploads/form_e_gate/signatures/' . $name, $decodedDocs);


                $formEGate->update(
                    [
                        'gate_signature_driver_check_in' => $name,
                    ]
                );
            }
            //versi file
            // if($request->file('gate_signature_driver_check_in')){
            //     // $file = 'uploads/attendance/signatures/'.$formEGate->gate_signature_driver_check_in;

            //     // if (is_file($file)) {
            //     //     unlink(public_path($file));
            //     // }
            //     $name = time()."_gate_signature_driver_check_in.png";
            //     $request->file('gate_signature_driver_check_in')->move('uploads/form_e_gate/signatures',$name);

            //     $formEGate->update(
            //         [
            //             'gate_signature_driver_check_in' => $name,
            //             ]
            //         );

            // }
            //     $formEGate->update(
            //         [
            //             'gate_loading_status' => (int) FormEGateCheck::
            //             returnEgateStatus($formEGate),
            // 'gate_is_editable'=> (int) FormEGateCheck::
            // returnIsEditable($formEGate),
            //             ]
            //         );
            
            // sending mail 
            

            return response()->json([
                'code' => 200,
                'message' => 'Success Create Data',
                'data' =>
                // $request->input('gate_signature_employee_check_in')
                [new FormEGateResource($formEGate)]
                // [$formEGate]
            ], 200);
        }
    }

    public function deleteEgateForm($id)
    {
        try {
            $gateForm = FormEGateCheck::findOrFail($id);
            $gateable = $gateForm->gateable;
            if ($gateable != null) {
                $gateable->delete();
            }
            $gateForm->delete();

            return response()->json([
                'code' => 200,
                'message' => 'Success Delete Data',
                'data' => [new FormEGateResource($gateForm)]
                // [$gateForm]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
            ], 404);
        }
    }

    public function deleteEgateFormGateable($id)
    {
        try {
            $gateForm = FormEGateCheck::findOrFail($id);
            $gateable_id = $gateForm->gateable_id;
            $gateable_type = $gateForm->gateable_type;
            if ($gateable_id != 0 && $gateable_type != null) {
                $gateForm->update([
                    'gateable_id' => 0,
                    'gateable_type' => null,
                ]);
            }

            return response()->json([
                'code' => 200,
                'message' => 'Success Delete Gateable of E Gate Form',
                'data' => [new FormEGateResource($gateForm)]
                // [$gateForm]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
            ], 404);
        }
    }

    public function approveEgateForm($idForm)
    {
        try {
            $employee = Auth::user();

            // $formEGate = FormEGateCheck::findOrFail($idForm);
            $formEGate = $employee->formEGateCheck()->findOrFail($idForm);

            $formEGate->update([
                'gate_approve_admin' => $employee->id,
                'gate_approve_admin_date' => Carbon::now(),
                'gate_report_status' => 1,
                'gate_is_approve' => 1,
            ]);
            return response()->json([
                'code' => 200,
                'message' => 'Success Approve Data',
                'data' => [new FormEGateResource($formEGate)]
                // [$formEGate]
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'code' => 404,
                'message' => 'Given E Gate Form ID not found',
                'data' => []
            ], 404);
        }
    }
}
