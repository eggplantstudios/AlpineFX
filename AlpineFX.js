var script = document.createElement('script');
script.src = 'http://localhost:8888/alpinefx/AlpineFX/?resource=' + document.getElementById('alpinefx').getAttribute('data-resource');
document.body.appendChild(script);

function AlpineFXCallback(jsondata){
    document.getElementById('alpinefx').innerHTML = jsondata.html;
}