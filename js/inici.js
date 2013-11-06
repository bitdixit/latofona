function entra(){
		// Recuperem les imatges
		var imatges = document.getElementsByTagName("img");

		//Desactivem l'event onclick
		imatges[0].onclick="";
		imatges[1].onclick="";

		//Obrim l'aplicació en una nova finestra sense barres d'eines, barra de navegació, menú,...
	  	var win = window.open("index.php","_blank_","directories=no,location=no,menubar=no,status=no,toolbar=no,scrollbars=yes");

		//Maximitzem la nova finestra
		win.outerHeight = screen.availHeight;
		win.outerWidth = screen.availWidth;

		//Tornem a activar l'event onclick
		imatges[0].onclick=entra;
		imatges[1].onclick=entra;
}