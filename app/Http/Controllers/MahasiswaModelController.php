<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use Illuminate\Http\Request;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\Validator;




class MahasiswaModelController extends Controller
{
    public function index(Request $request)
    {
        $mahasiswa = Mahasiswa::orderby('id', 'ASC')->get();
        $response = ApiFormatter::createJson(200, 'Get Data Success', $mahasiswa);
        return response()->json($response);
    }

    public function create(Request $request)
    {
        try {
            $params = $request->all();

            $validator = Validator::make(
                $params,
                [

                    'mahasiswa_nim' => 'required',
                    'mahasiswa_nama' => 'required',
                ],
                [
                    'mahasiswa_nim.required' => 'City mahasiswa_nim is required',
                    'mahasiswa_nama.required' => 'nama mahasiswa is required',
                ]
            );

            if ($validator->fails()) {
                $response = ApiFormatter::createJson(400, 'Bad Request', $validator->errors()->all());
                return response()->json($response);
            }

            $mahasiswa = [
                'mahasiswa_nim' => $params['mahasiswa_nim'],
                'mahasiswa_nama' => $params['mahasiswa_nama'],
            ];

            $data = Mahasiswa::create($mahasiswa);
            $createdmahasiswa = Mahasiswa::find($data->id);

            $response = ApiFormatter::createJson(200, 'Create mahasiswa success', $createdmahasiswa);
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ApiFormatter::createJson(500, 'Internal Server Error', $e->getMessage());
            return response()->json($response);
        }
    }

    public function detail($id)
    {
        try {
            $mahasiswa = Mahasiswa::find($id);

            if (is_null($mahasiswa)) {
                return ApiFormatter::createJson(404, 'mahasiswa not found');
            }

            $response = ApiFormatter::createJson(200, 'Get detail mahasiswa sucess', $mahasiswa);
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ApiFormatter::createJson(400, $e->getMessage());
            return response()->json($response);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $params = $request->all();

            $premahasiswa = Mahasiswa::find($id);
            if (is_null($premahasiswa)) {
                return ApiFormatter::createJson(404, 'Data not found');
            }

            $validator = Validator::make(
                $params,
                [

                    'mahasiswa_nim' => 'required',
                    'mahasiswa_nama' => 'required',
                ],
                [
                    'province.required' => 'Province id is required',
                    'mahasiswa_nim.required' => 'mahasiswa_nim Type is required',
                    'mahasiswa_nama.required' => 'mahasiswa Name is required',
                ]
            );

            if ($validator->fails()) {
                $response = ApiFormatter::createJson(400, 'Bad Request', $validator->errors()->all());
                return response()->json($response);
            }

            $mahasiswa = [

                'mahasiswa_nim' => $params['mahasiswa_nim'],
                'mahasiswa_nama' => $params['mahasiswa_nama'],
            ];

            $premahasiswa->update($mahasiswa);
            $updatedmahasiswa = $premahasiswa->fresh();

            $response = ApiFormatter::createJson(200, 'Update mahasiswa success', $updatedmahasiswa);
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ApiFormatter::createJson(500, 'Internal Server Error', $e->getMessage());
            return response()->json($response);
        }
    }

    public function patch(Request $request, $id)
    {
        try {
            $params = $request->all();

            $premahasiswa = Mahasiswa::find($id);
            if (is_null($premahasiswa)) {
                return ApiFormatter::createJson(404, 'Data not found');
            }

            if (isset($params['id'])) {
                $validator = Validator::make(
                    $params,
                    [
                        'id' => 'required',
                    ],
                    [
                        'id.required' => 'id is required',
                    ]
                );

                if ($validator->fails()) {
                    $response = ApiFormatter::createJson(400, 'Bad Request', $validator->errors()->all());
                    return response()->json($response);
                }

                $mahasiswa['id'] = $params['id'];
            }

            if (isset($params['mahasiswa_nim'])) {
                $validator = Validator::make(
                    $params,
                    [
                        'mahasiswa_nim' => 'required',
                    ],
                    [
                        'mahasiswa_nim.required' => 'mahasiswa mahasiswa_nim is required',
                    ]
                );

                if ($validator->fails()) {
                    $response = ApiFormatter::createJson(400, 'Bad Request', $validator->errors()->all());
                    return response()->json($response);
                }

                $mahasiswa['mahasiswa_nim'] = $params['mahasiswa_nim'];
            }

            if (isset($params['nama_mahasiswa'])) {
                $validator = Validator::make(
                    $params,
                    [
                        'mahasiswa_nama' => 'required',
                    ],
                    [
                        'mahasiswa_nama.required' => 'mahasiswa Name is required',
                    ]
                );

                if ($validator->fails()) {
                    $response = ApiFormatter::createJson(400, 'Bad Request', $validator->errors()->all());
                    return response()->json($response);
                }

                $mahasiswa['mahasiswa_nama'] = $params['mahasiswa_nama'];
            }

            $premahasiswa->update($mahasiswa);
            $updatedmahasiswa = $premahasiswa->fresh();

            $response = ApiFormatter::createJson(200, 'Update mahasiswa success', $updatedmahasiswa);
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ApiFormatter::createJson(500, 'Internal Server Error', $e->getMessage());
            return response()->json($response);
        }
    }

    public function delete($id)
    {
        try {
            $mahasiswa = Mahasiswa::find($id);

            if (is_null($mahasiswa)) {
                return ApiFormatter::createJson(404, 'Data not found');
            }

            $mahasiswa->delete();

            $response = ApiFormatter::createJson(200, 'Delete mahasiswa success');
            return response()->json($response);
        } catch (\Exception $e) {
            $response = ApiFormatter::createJson(500, 'Internal Server Error', $e->getMessage());
            return response()->json($response);
        }
    }
}
