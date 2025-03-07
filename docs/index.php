<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>サイトタイトル</title>
        <meta name="description" content="ディスクリプションを入力">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <!-- [if lt IE 9] -->
        <!-- <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script> -->
        <!-- [endif] -->
        
    </head>

    <body>
        <script src="https://unpkg.com/encoding-japanese@2.2.0/encoding.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        
        <!----- header----->
        <header>
            <h1 class="headline">
                <a>サンプルのサイト</a>
            </h1>
            <ul class="nav-list">
                <li class="nav-list-item">
                    <a>Home</a>
                </li>
                <li class="nav-list-item">About</li>
                <li class="nav-list-item">Topic</li>
            </ul>

            <!-- <script type="importmap">
            {
                "imports": 
                {
                    "spz-js": "../node_modules/spz-js/dist"
                }
            }
            </script> -->
            <!-- <script type="importmap">
            {
                "imports": 
                {
                    "ply-loader": "../node_modules/spz-js/dist/ply-loader.js",
                    "spz-loader": "../node_modules/spz-js/dist/spz-loader.js"
                }
            }
            </script> -->
            <!-- <script type="importmap">
            {
                "imports": 
                {
                    "spz-js": "https://github.com/arrival-space/spz-js/tree/master/dist"
                }
            }
            </script> -->
            <!-- <script type="importmap">
            {
                "imports": 
                {
                    "ply-loader": "https://raw.githubusercontent.com/arrival-space/spz-js/refs/heads/master/dist/ply-loader.js",
                    "spz-loader": "https://raw.githubusercontent.com/arrival-space/spz-js/refs/heads/master/dist/spz-loader.js"
                }
            }
            </script> -->

        </header>

        <!----- main ----->
        <article id="dropbox">

            <ul class="flex-container">
                <li>
                    <h1>タイトル</h1>
                </li>
                <!-- <section>
                    <h2>見出し２</h2>
                </section> -->
            </ul>

            <form method="post" enctype="multipart/form-data" action="./index.php" method="POST">
                <div>
                    <!-- <label for="image_uploads">
                        アップロードするファイルを選択してください。
                    </label> -->
                    <!-- <input
                        type="file"
                        id="image_uploads" 
                        class="select" 
                        name="image_uploads"
                        accept=".jpg, .jpeg, .png"
                        multiple 
                    /> -->
                    <input
                        type="file"
                        id="fileUpload" 
                        class="select" 
                        name="uploadfile" 
                        accept=".ply, .spz, .txt, .json"
                        multiple 
                    />
                    <!-- <button id="fileSelect" type="button">画像を選択</button> -->
                </div>
                <div class="preview">
                  <p>アップロードするファイルが選択されていません。</p>
                </div>
                <div>
                  <!-- <button>送信</button> -->
                  <input type="submit" value="Submit"></input>
                </div>
              </form>

              <button type="button" id="btn">test</button>

        </article>

        <!-- <footer>フッター</footer> -->

        <script src="main.js"></script>
        <!-- <script type="module" src="plyspz.js" ></script> -->
        <script type="module">
        
            <?php
                readfile( "plyspz.js" );
            ?>

            // let button = document.getElementById( 'btn' );
            function OnSubmitButtonClicked()
            {
                <?php                
                $send = isset( $_FILES['uploadfile'] );
                $empty = empty( $_FILES['uploadfile']['tmp_name'] );
                $tmp = $_FILES['uploadfile']['tmp_name'];
                $name = $_FILES['uploadfile']['name'];
                ?>

                let send = "<?php echo $send ?>";
                let emp = "<?php echo $empty ?>";
                let tmp = "<?php echo $tmp ?>";
                let nm = "<?php echo $name ?>";
                
                alert( 'ボタンクリック.' );
                alert( tmp + " / " + nm );

                // if( send )
                // {
                //     console.log( "not send" );
                // } 
                // else
                // {
                //     // ファイルデータがあるかの確認.
                //     if( !emp )
                //     {
                //         // アップロードの位置と名前を設定.
                //         let upName = "../upload/" + nm; 
                //         // アップロード処理.
                //         if( move_uploaded_file( tmp, upName ) )
                //         {
                //             alert( 'アップロード成功' );
                //         }
                //         else
                //         {
                //             alert( 'アップロード失敗' );
                //         }
                //     }
                //     else
                //     {
                //         console.log( "nothing" );
                //     }

                // }



                
                <?php
                    // ファイルデータがあるかの確認.
                    if( !empty( $_FILES['uploadfile']['tmp_name'] ) )
                    {
                        // アップロードの位置と名前を設定.
                        $upName = "../upload/".$_FILES['uploadfile']['name']; 
                        echo "
                                alert( 'php upload' );   
                            ";
                    }
                    else
                    {
                        echo "
                            alert( 'php not selected' );  
                        ";
                    }
                ?>
            }
            // button.onclick = OnSubmitButtonClicked;

            Test( "------" );
            

        </script>

        <script type="module">
            <?php     
                // require ( '../vendor/autoload.php' );
                readfile( "plyspz.js" );           
                
                $fileName = 'uploadfile';
                $extension = '.ply';

                // 送信ボタンからの遷移か確認.
                // if( isset( $_FILES['uploadfile'] ))
                // {
                //     // ファイルデータがあるかの確認.
                //     if( !empty( $_FILES['uploadfile']['tmp_name'] ) )
                //     {
                //         // アップロードの位置と名前を設定.
                //         $upName = "../upload/".$_FILES['uploadfile']['name']; 

                //         // アップロード処理.
                //         if( move_uploaded_file( $_FILES['uploadfile']['tmp_name'], $upName ) )
                //         {     
                if( isset( $_FILES[ $fileName ] ))
                {
                    // ファイルデータがあるかの確認.
                    if( !empty( $_FILES[ $fileName ]['tmp_name'] ) )
                    {
                        // アップロードの位置と名前を設定（元ファイルの名前を使用したい場合は上）.
                        // $upName = "../upload/".$_FILES[ $fileName ]['name']; 
                        $upName = "../upload/".$fileName.$extension;

                        // アップロード処理.
                        if( move_uploaded_file( $_FILES[ $fileName ]['tmp_name'], $upName ) )
                        {          
                            
           

                            echo "                                

                                let fileName = '$fileName';
                                let extension = '$extension';
                                let plyUrl = 'https://vxvcojp.xsrv.jp/sandbox/p/p0168_3dgs/upload_dev/upload/' + fileName + extension;
                                let uploadUrl = 'upload.php?name=' + fileName;

                                alert( 'PLY アップロード 完了。' + fileName + extension );

                                window.onload = function() 
                                {
                                    document.getElementById('btn').onclick = async function() 
                                    {
                                        var spz = await LoadFile( plyUrl );

                                        console.log( spz );

                                        // 1. Blobオブジェクトを作成する
                                        const blob = new Blob( [ spz ], { type: 'text/plain' });
                                        console.log( blob );

                                        // ローカルに保存するとき --------------------------------
                                        // // 2. HTMLのa要素を生成
                                        // const link = document.createElement('a');
                                        // // 3. BlobオブジェクトをURLに変換
                                        // link.href = URL.createObjectURL( blob );
                                        // // 4. ファイル名を指定する
                                        // link.download = 'test.spz';
                                        // // 5. a要素をクリックする処理を行う
                                        // link.click();
                                        // ----------------------------------------------------

                                        // SPZ保存. 
                                        var response = await fetch( uploadUrl, 
                                        { 
                                            method: 'POST',
                                            headers: { 'Content-Type': 'text/plain' },
                                            mode: 'cors',
                                            credentials: 'same-origin',
                                            body: blob,
                                        });

                                        let data = await response.text();
                                        let parse = JSON.parse( data );
                                        console.log( parse );

                                        if( parse.Response.ID == 0 )
                                        {
                                            alert( 'SPZアップロード完了' );    
                                        }
                                        else
                                        {
                                            alert( 'SPZアップロード失敗' );   
                                        }  
                                                               
                                        
                                    }
                                };";



                            
                            // $client = new Google\Client();
                            // $client->setAuthConfig( 'modeldata-spread-f15a72f80aa7.json' );
                            // $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
                            // $service = new Google_Service_Sheets($client);
                            // $spreadsheet_id = '1UdrhpwZle0wq8S7lrJhZGWpm6mI3qMDfOSTVmt6QQ0U';
                            // $response = $service->spreadsheets->get($spreadsheet_id);
                            // $title = $response->properties->title;
                            // var_dump( $title );
                             
                            // $key = __DIR__ . '/modeldata-spread-f15a72f80aa7.json';
                            // $sheet_id = "1UdrhpwZle0wq8S7lrJhZGWpm6mI3qMDfOSTVmt6QQ0U";

                            // $client = new \Google_Client();
                            // $client->setAuthConfig($key);
                            // $client->addScope(\Google_Service_Sheets::SPREADSHEETS);
                            // $client->setApplicationName("Test"); // 適当な名前でOK
                            // $sheet = new \Google_Service_Sheets($client);


                            // // * シートデータの取得
                            // $sheet_name = "sheet1"; // シートを指定
                            // $sheet_range = "A2:C4"; // 範囲を指定。開始から終了まで斜めで囲む感じです。
                            // $response = $sheet->spreadsheets_values->get($sheet_id, $sheet_name.'!'.$sheet_range);
                            // foreach ($response->getValues() as $index => $cols) 
                            // {
                            //     var_dump($cols);
                            //     // echo "
                            //     //     alert( 'aaaaaaaaaaaaaaaaaaa' );  
                            //     // ";
                            // }


                        }
                        else
                        {
                            // echo "アップロードに失敗しました。";
                            echo "
                                alert( 'アップロード失敗' );
                            ";
                        }
                    }
                    else
                    {
                        // echo "ファイルを選択してください";
                        echo "
                            alert( 'ファイルを選択してください' );  
                        ";
                    }
                }
                else
                {
                    // <console class="log">p</console> "-----------------";
                }

            ?>
            

        </script>
    </body>
</html>


