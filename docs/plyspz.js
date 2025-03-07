// import 
// {
//     loadPly,
//     loadSpz
// } from 'spz-js';
// } from './node_modules/spz-js';

import { loadPly } from '../node_modules/spz-js/dist/ply-loader.js';
import { loadSpz } from '../node_modules/spz-js/dist/spz-loader.js';
import { serializeSpz } from '../node_modules/spz-js/dist/spz-serializer.js';

// const loadFile = async (url) => 
// export async function LoadFile( url )
// {
//     const response = await fetch(url);
//     const extension = url.split('.').pop();
    
//     if (extension === 'spz') 
//     {
//         const buffer = await response.arrayBuffer();
//         return await loadSpz(buffer);
//     } 
//     else if (extension === 'ply') 
//     {
//         return await loadPly(response.body);
//     }

//     throw new Error(`Unsupported file extension: ${extension}`);
// }


async function Test( url )
{
    console.log( "Test _Func" );
    console.log( url );
    
    var api_url = 'https://script.google.com/macros/s/AKfycbyjwSMYaPNsOMorp0InFRN_V_sUHjBNtBy2UV0gLxwZZKkbkfXoU1-NBtPAGie378cN/exec';
    // https://docs.google.com/spreadsheets/d/1UdrhpwZle0wq8S7lrJhZGWpm6mI3qMDfOSTVmt6QQ0U/edit?usp=sharing
    // https://docs.google.com/spreadsheets/d/"+ sheetId +"/gviz/tq?tqx=out:json&sheet=" + sheetName
    // https://docs.google.com/spreadsheets/d/1UdrhpwZle0wq8S7lrJhZGWpm6mI3qMDfOSTVmt6QQ0U/gviz/tq?tqx=out:json&sheet=sheet1
    // var api_url = 'https://docs.google.com/spreadsheets/d/1UdrhpwZle0wq8S7lrJhZGWpm6mI3qMDfOSTVmt6QQ0U/gviz/tq?tqx=out:json&sheet=sheet1';
 
    // var res = await fetch( api_url,     
    // {
    //     // method: 'GET',
    //     headers: { 'Content-Type': 'text/plain' },
    //     // body: blob,
    //     mode: 'no-cors'
    //     // credentials: 'same-origin'
    // } );
    // var txt = await res.text();
    // console.log( txt );
    // const blob = new Blob( [ txt ], { type: 'text/plain' });
    // // 2. HTMLのa要素を生成
    // const link = document.createElement('a');
    // // 3. BlobオブジェクトをURLに変換
    // link.href = URL.createObjectURL( blob );
    // // 4. ファイル名を指定する
    // link.download = 'loadtest.txt';
    // // 5. a要素をクリックする処理を行う
    // link.click();


    // .then( function (fetch_data) 
    // {
    //     return fetch_data.json();
    // })
    // .then( function (json) 
    // {
    //     for (var i in json) 
    //     {
    //         console.log(json[i].name);
    //     }
    // });
}


    



async function LoadFile( url )
{
    const response = await fetch(url);
    const extension = url.split('.').pop();
    
    if (extension === 'spz') 
    {
        console.log( 'このファイルは SPZ.' );

        return null;
    } 
    else if (extension === 'ply') 
    {
        console.log( 'このファイルは PLY.' );
        var gs = await loadPly( response.body );

        if( gs == null )
        {
            console.log( "gs is Null." );
            return null;
        }
        else
        {
            var file = serializeSpz( gs );
            return file;
        }
    }

}