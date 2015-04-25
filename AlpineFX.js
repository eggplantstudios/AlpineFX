var elements = document.getElementsByClassName('alpinefx'), i;

for (var i = 0; i < elements.length; ++i) {
    var script = document.createElement('script');
    script.src = 'http://localhost:8888/alpinefx/AlpineFX/?resource=' + elements[i].getAttribute('data-resource');
    document.body.appendChild(script);
}

function AlpineFXCallback(jsondata){
    var id = 'alpinefx-' + jsondata.resource;
    document.getElementById(id).innerHTML = jsondata.html;
}