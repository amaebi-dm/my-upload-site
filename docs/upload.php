<?php
    require ( '../vendor/autoload.php' );
    $raw = file_get_contents( 'php://input' ); // POSTされた生のデータを受け取る
    // $data = json_decode( $raw, true ); // json形式をphp変数に変換

    // アップロード処理.
    if( $raw != null )
    {        
        $fileName = 'sample';
        $extension = ".spz";
        if( isset( $_GET['name'] )) 
        {
            $fileName = $_GET['name'];
        }
        $path = "../upload/".$fileName.$extension;

        file_put_contents( $path, $raw );


        // "https://vxvcojp.xsrv.jp/sandbox/p/p0168_3dgs/exSample.spz";
        // "https://vxvcojp.xsrv.jp/sandbox/p/p0168_3dgs/upload_dev/upload/uploadfile.spz";
        $folderPath = "https://vxvcojp.xsrv.jp/sandbox/p/p0168_3dgs/upload_dev/upload/";
        $spzFilePath = $folderPath.$fileName.$extension;

        
        // ファイルリストの読込（仮）.
        $fileListPath = "../upload/fileListSamle.json";
        $readList = file_get_contents( $fileListPath );


        // ファイルリスト追加.（Jsonデータとして保管しておく用の想定。現状は仮データをいれて書き出ししているだけ。）
        // $fileListPath = "../upload/fileListSamle.json";
        $fileListData = "{ \"ID\" : 0, \"Name\" : \"fileName\", \"URL\" : \"http://aaaaaaa\" }";
        // file_put_contents( $path, $fileListData, FILE_APPEND );
        file_put_contents( $fileListPath, $fileListData );


        // スプレッドシートの値を取得.
        // JSONやIDはvxvメール（momii.daiji@vxv.co.jp）のaccountで作成したスプレッドシート、またGCPのモノなので変更が必要です.
        $sheet_name = "sheet1";
        $sheet_range = "A2:C4";
        $client = new Google\Client();
        $client->setAuthConfig( 'modeldata-spread-f15a72f80aa7.json' );
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        $service = new Google_Service_Sheets($client);
        $spreadsheet_id = '1UdrhpwZle0wq8S7lrJhZGWpm6mI3qMDfOSTVmt6QQ0U';


        // 返答用のJson形式文字列の作成.
        // $response = $service->spreadsheets->get($spreadsheet_id);
        // $response = $service->spreadsheets->get($spreadsheet_id, $sheet_name.'!'.$sheet_range);
        $response = $service->spreadsheets_values->get($spreadsheet_id, $sheet_name.'!'.$sheet_range);
        $title = $response->properties->title;
        // $sheet = $response->getSheets()[0];        
        $rows = $response->getValues();
        $log = ">> ";
        $param = "\"Response\" : { \"ID\": 0, \"Result\": \"Success\", \"Path\": \"".$path."\", \"Log\" : \"---\" },";
        $listStr = "\"FileList\" : { \"ID\": 0, \"Name\": \".$fileName.$extension.\", \"URL\": \"".$spzFilePath."\" },";
        $data = "{ ".$param.$listStr." \"Data\" : [ ";
        $outIndex = 0;
        foreach ( $rows as $i => $row ) 
        {
            $innerIndex = 0;
            $data .= "{ ";
            foreach( $row as $value )
            {
                if( $innerIndex == 0 ) $data .= "\"Name\" : \"".$value."\", ";
                if( $innerIndex == 1 ) $data .= "\"Value\" : \"".$value."\", ";
                if( $innerIndex == 2 ) $data .= "\"Disc\" : \"".$value."\" ";

                $innerIndex += 1;
                $log .= $value." / ";
            }
            
            if( $outIndex == 2 ) $data .= "} ] }"; 
            else $data .= "}, ";
            $outIndex += 1;
        }


        // スプレッドシートに値を追加（値の追加テスト。データ形式が未定のため現状追加データは適当。）.
        $addData = new Google_Service_Sheets_ValueRange(
            [
                'values' => 
                [
                    ['aiueo', 'かきくけこ'],
                    ['さしすせと', 'たちつてと']
                ]
            ]);
        // $service->spreadsheets_values->update( $spreadsheet_id, 'sheet1!A5', $addData, 
        $service->spreadsheets_values->append( $spreadsheet_id, 'sheet1!A5', $addData, 
        [
                'valueInputOption' => 'USER_ENTERED'
        ]);
        



        
        // $response = "{ \"ID\": 0, \"Result\": \"Success\", \"Path\": \"".$path."\", \"Log\": \"".$log."\" }";
        // echo $response;
        echo $data;
    }
    else
    {
        $response = "{ \"ID\": 1, \"Result\": \"Failure\", \"Path\": \"null\" }";
        echo $response;
    }
?>