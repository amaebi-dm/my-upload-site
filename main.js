// ファイルインプットの余計な文字を消すためにボタンでラップ.
const fileSelect = document.getElementById("fileSelect");
const fileElem = document.getElementById("fileUpload");

fileSelect.addEventListener("click", (e) => 
{
    if (fileElem) 
    {
        fileElem.click();
    }
}, false);



// インプット.
const input = document.querySelector( ".select" );
const preview = document.querySelector( ".preview" );

// input.style.opacity = 0;

input.addEventListener( "cancel", () => 
{
    console.log("Cancelled.");
});

input.addEventListener( "change", () => 
{
    if ( input.files.length == 1 )
    {
        console.log("File selected: ", input.files[0]);
    }

    while ( preview.firstChild ) 
    {
        preview.removeChild( preview.firstChild );
    }
    
    const curFiles = input.files;
    updateDisplay( curFiles );
});


function updateDisplay( files )
{
    // while ( preview.firstChild ) 
    // {
    //     preview.removeChild( preview.firstChild );
    // }
    
    // const curFiles = input.files;
    if (files.length === 0) 
    {
        const para = document.createElement("p");
        para.textContent = "アップロードするファイルが選択されていません";
        preview.appendChild(para);
    } 
    else 
    {
        const list = document.createElement("ol");
        preview.appendChild(list);

        for (const file of files) 
        {
            const listItem = document.createElement("li");
            const para = document.createElement("p");
            para.textContent = `ファイル名: ${file.name}, ファイルサイズ: ${returnFileSize(file.size,)}.`;
            listItem.appendChild(para);
            list.appendChild(listItem);
        }
    }
}

// https://developer.mozilla.org/ja/docs/Web/Media/Formats/Image_types
const fileTypes = [".txt", ".json", ".ply", ".spz"];

function validFileType(file) 
{
    return fileTypes.includes(file.type);
}

function returnFileSize(number) 
{
    if (number < 1e3) 
    {
        return `${number} バイト`;
    } 
    else if (number >= 1e3 && number < 1e6) 
    {
        return `${(number / 1e3).toFixed(1)} KB`;
    } 
    else 
    {
        return `${(number / 1e6).toFixed(1)} MB`;
    }
}



let dropbox;

dropbox = document.getElementById("dropbox");
dropbox.addEventListener("dragenter", dragenter, false);
dropbox.addEventListener("dragover", dragover, false);
dropbox.addEventListener("drop", drop, false);

function dragenter(e) 
{
    e.stopPropagation();
    e.preventDefault();

    console.log( "dragenter" );
}
  
function dragover(e) 
{
    e.stopPropagation();
    e.preventDefault();

    console.log( "dragover" );
}

function drop(e) 
{
    e.stopPropagation();
    e.preventDefault();
  
    const dt = e.dataTransfer;
    const files = dt.files;
  
    while ( preview.firstChild ) 
    {
        preview.removeChild( preview.firstChild );
    }
    updateDisplay( files );

    console.log( "Drop" );
    console.log( files );
}

function handleFiles(files) 
{
    for (let i = 0; i < files.length; i++) 
    {
        const file = files[i];

        // if (!file.type.startsWith("image/")) 
        // {
        //     continue;
        // }
  
        const img = document.createElement("img");
        img.classList.add("obj");
        img.file = file;
        preview.appendChild(img); // 「プレビュー」とは、コンテンツが表示される div 出力のことを想定しています。

        const reader = new FileReader();
        reader.onload = (e) => {
        img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
  }
