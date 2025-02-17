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
                        style="display:none"
                    />
                    <button id="fileSelect" type="button">画像を選択</button>
                </div>
                <div class="preview">
                  <p>アップロードするファイルが選択されていません。</p>
                </div>
                <div>
                  <!-- <button>送信</button> -->
                  <input type="submit" value="Submit"></input>
                </div>
              </form>

        </article>

        <!-- <footer>フッター</footer> -->

        <script src="main.js"></script>
    </body>
</html>

<?php

    // 送信ボタンからの遷移か確認.
    if( isset( $_FILES['uploadfile'] ))
    {
        // ファイルデータがあるかの確認.
        if( !empty( $_FILES['uploadfile']['tmp_name'] ) )
        {
            // アップロードの位置と名前を設定.
            $upName = "./upload/".$_FILES['uploadfile']['name']; 

            echo $upName;

            // アップロード処理.
            if( move_uploaded_file( $_FILES['uploadfile']['tmp_name'], $upName ) )
            {
                echo "アップロードに成功しました。"; 
            }
            else
            {
                echo "アップロードに失敗しました。";
            }
        }
        else
        {
            echo "ファイルを選択してください";
        }
    }
    else
    {
        // <console class="log">p</console> "-----------------";
    }
?>