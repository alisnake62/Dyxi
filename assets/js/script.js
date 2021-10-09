//premier traitement
//images background deleting
let images = document.getElementsByTagName('img');
nb_images = images.length
for (var i = 0; i < nb_images; i++) {
    images[0].parentNode.removeChild(images[0]);
}
document.body.style.backgroundColor = "#FFFFFF";


//police et taille police
ratio_police_size = parseFloat(document.currentScript.getAttribute('ratio_police_size'));
police = document.currentScript.getAttribute('police');
texte_elements = document.querySelectorAll('p');
texte_elements.forEach((line) => {
    line.style.fontSize = Math.round(16 * ratio_police_size) + 'px';
    line.style.fontFamily = police;
})

//saut de ligne
/*
page1 = document.children[0].children[1].children[0];
page1.children[7].style.top="2000px";
*/



//surlignage appuis sur entrée
function getSelected() {
	if(window.getSelection) { return window.getSelection(); }
	else if(document.getSelection) { return document.getSelection(); }
	else {
		var selection = document.selection && document.selection.createRange();
		if(selection.text) { return selection.text; }
		return false;
	}
	return false;
}

let test_toto = ' test'
document.onkeyup = function(event) {
    var keyCode = event.which || event.keyCode;
    if(keyCode == 13) {
        var mot = getSelected();
        if(mot != false){
            window.open('../syn.php?mot=' + mot,'synonyme','menubar=no, scrollbars=no, top=100, left=100, width=600, height=500');
        }
    }
}

