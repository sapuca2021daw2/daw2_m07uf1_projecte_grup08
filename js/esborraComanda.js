function esborraComanda(idComanda) {
    var urlCodi = "/daw2_m07uf1_projecte_grup08/comandes/elComanda.php?q=";
    var metode = "DELETE";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4) {
            if ((xhttp.status == 200) || (xhttp.status == 403) || (xhttp.status == 404) || (xhttp.status == 405)) {
                // document.getElementById("resp").innerText = xhttp.responseText;
            }
        }
    };
    xhttp.open(metode, urlCodi + idComanda, true);
    xhttp.send();
    window.location.reload();

}