<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\DB;
use App\Models\Zip;

class ZipCodesNoSqlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $filename = ('./public/data/CPdescarga.txt');
            // $filename = ('./public/data/zip_codes.txt');

            $count = 0;
            $data = Array(); $insertData = Array();
            foreach (file($filename) as $line) {
                $r = explode('|', $line);
                $id = (string) $r[0];
                $zip = Array(
                    'zip_code' => (string) $r[0],
                    'locality' => self::applyChallengeFormat($r[4]),
                    'federal_entity' => Array(
                        'key' => (int) $r[7],
                        'name' => self::applyChallengeFormat($r[5]),
                        'code' =>  (isEmpty($r[9])) ? null : (int) $r[9]
                    ),
                    'settlements' => Array(
                        Array(
                            'key' => (int) trim($r[12]),
                            'name' => self::applyChallengeFormat($r[1]),
                            'zone_type' => self::applyChallengeFormat($r[13]),
                            'settlement_type' => Array(
                                'name' => ucwords($r[2])
                            )
                        )
                    ),
                    'municipality' => Array(
                        'key' => (int) $r[11],
                        'name' => self::applyChallengeFormat($r[3]),
                    )
                );
                $count++;
                if(empty($data[$id])){
                    //si no existe agregamos el registro
                    $data[$id] = $zip;
                    $insertData[$id] = Array('id' => $id, 'data' => json_encode($data[$id], JSON_UNESCAPED_UNICODE));
                }else{
                    // si ya existe agregamos los settlements
                    $settlements = $data[$id]['settlements'];
                    $settlements = array_merge($settlements, $zip['settlements']);
                    $zip['settlements'] = $settlements;
                    $data[$id] = $zip;
                    $insertData[$id] = Array('id' => $id, 'data' => json_encode($data[$id], JSON_UNESCAPED_UNICODE));
                }
            }
            self::insertChuckData($insertData);
    }
    private function insertChuckData($data){
        // DB::disableQueryLog();

        //clear data before inserting
        Zip::truncate();
        //insert from 1000 groups
        $chunkData = array_chunk($data, 1000);
        if (isset($chunkData) && !empty($chunkData)) {
            $c = 0;
            foreach ($chunkData as $key => $chunkVal) {
                Zip::insert($chunkVal);
            }
        }
   }

   private function applyChallengeFormat($cadena){

       //Reemplazamos la A y a
       $cadena = str_replace(
       array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
       array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
       $cadena
       );

       //Reemplazamos la E y e
       $cadena = str_replace(
       array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
       array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
       $cadena );

       //Reemplazamos la I y i
       $cadena = str_replace(
       array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
       array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
       $cadena );

       //Reemplazamos la O y o
       $cadena = str_replace(
       array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
       array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
       $cadena );

       //Reemplazamos la U y u
       $cadena = str_replace(
       array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
       array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
       $cadena );

       //Reemplazamos la N, n, C y c
       $cadena = str_replace(
       array('Ñ', 'ñ', 'Ç', 'ç'),
       array('N', 'n', 'C', 'c'),
       $cadena
       );

       return (string) strtoupper($cadena);
   }
}
