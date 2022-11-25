function Verif() {
  var inputs = document.getElementsByTagName('input');
  for(var i = 0; i < inputs.length; i++ ){
    if(inputs[i].value !== '')
        return true;
    else {
        alert('Veuillez remplir tous les champs !');
        return false;

    }    
  }
}
