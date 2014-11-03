function showPlanning(an, groupe, numsem) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      document.getElementById("planning").innerHTML = xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","?an=" + an + "&groupe=" + groupe + "&numsem=" + numsem, true);
  window.history.pushState('', '', '?an=' + an + '&groupe=' + groupe + '&numsem=' + numsem);
  xmlhttp.send();
}

function getParamValue(param,url)
{

  // Récupère la valeur d'un parametre dans l'url (GET)
  
  var u = url == undefined ? document.location.href : url;
  var reg = new RegExp('(\\?|&|^)'+param+'=(.*?)(&|$)');
  matches = u.match(reg);
  return matches[2] != undefined ? decodeURIComponent(matches[2]).replace(/\+/g,' ') : '';
}

function listeSemaine(numsem) {
  window.history.pushState('', '', '?an=' + getParamValue('an') + '&groupe=' + getParamValue('groupe') + '&numsem'
				+ getParamValue('numsem'));
  showPlanning(getParamValue('an'), getParamValue('groupe'), numsem);
}
