import 
{
    loadPly,
    loadSpz
} from 'spz-js';

// const loadFile = async (url) => 
export async function LoadFile( url )
{
    const response = await fetch(url);
    const extension = url.split('.').pop();
    
    if (extension === 'spz') 
    {
        const buffer = await response.arrayBuffer();
        return await loadSpz(buffer);
    } 
    else if (extension === 'ply') 
    {
        return await loadPly(response.body);
    }

    throw new Error(`Unsupported file extension: ${extension}`);
}