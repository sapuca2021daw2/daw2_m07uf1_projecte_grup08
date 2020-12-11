function esborraUsuari(idUsuari) {
    var urlCodi = "/daw2_m07uf1_projecte_grup08/admin/esborraUsuari.php?q=";
    var metode = "DELETE";

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4) {
            if ((xhttp.status == 200) || (xhttp.status == 403) || (xhttp.status == 404) || (xhttp.status == 405)) {
                // document.getElementById("resp").innerText = xhttp.responseText;
            }
        }
    };
    xhttp.open(metode, urlCodi + idUsuari, true);
    xhttp.send();
    window.location.reload();

}