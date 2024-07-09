async function fetchData() {

    const url = 'https://streaming-availability.p.rapidapi.com/shows/search/filters?country=us&rating_max=90&show_type=movie&series_granularity=show&order_by=popularity_alltime&output_language=en&order_direction=asc&genres_relation=and';
    const options = {
        method: 'GET',
        headers: {
            'X-RapidAPI-Key': '82117eccacmsh7818317f398ac30p1e70e0jsn419ff5470ccc',
            'X-RapidAPI-Host': 'streaming-availability.p.rapidapi.com'
        }
    };

    try {

        const response = await fetch(url, options);
        const result = await response.json();

        console.log(result);
        console.log(result.shows);

        if (response.status === 200 && Array.isArray(result.shows) && result.shows.length != 0) {

            const listadoPeliculas = document.getElementById('peliculasapi');
            
            result.shows.forEach((peliculas) => {

            	const pelicula = document.createElement("div");
            	pelicula.className = "peli";
            	//pelicula.setAttribute("id", "peli");
                const i = 0;
            
                let titulo = peliculas.title;
                let actores = peliculas.cast;
                let direccion = peliculas.directors;
                let poster = peliculas.imageSet.horizontalPoster.w480;
                let linkpeli = peliculas.streamingOptions.us[i].link;
                let resumen = peliculas.overview;
                let empresa = "";
                let m = linkpeli.search("amazon");
                let p = linkpeli.search("apple");
                let q = linkpeli.search("paramountplus");
                let r = linkpeli.search("netflix");
                let x = linkpeli.search("max");
                let y = linkpeli.search("pluto");
                let z = linkpeli.search("tubi");
                let v = linkpeli.search("peacock");
                if(m != -1) {empresa = "Link a Amazon"}
                else if(p != -1) {empresa = "Link a Apple TV+"}
                else if(q != -1) {empresa = "Link a Paramount+"}
                else if(r != -1) {empresa = "Link a Netflix"}
                else if(x != -1) {empresa = "Link a MAX"}
                else if(y != -1) {empresa = "Link a Pluto.tv"}
                else if(z != -1) {empresa = "Link a Tubi.tv"}
                else if(v != -1) {empresa = "Link a Peacocktv"}
                else {empresa = "Sin link"}

                pelicula.innerHTML = 
                    `<img src="${poster}" alt="${titulo}" class="peliapi" />
                    <h3 class="apih3">${titulo}</h3>
                    <p class="apiactores"><span class="detalle"><strong>Resumen:</strong></span> ${resumen}</p>
                    <p class="apidir"><span class="detalle">Dirección:</span> <strong>${direccion}</strong></p>
                    <p class="apiactores"><span class="detalle">Actores:</span> <strong>${actores}</strong></p>
                    <p class="apilinkcont"><a href="${linkpeli}" target="_blank" class="apilink"><strong>${empresa}</strong></a></p>`;
                
                listadoPeliculas.append(pelicula);
            });
            
        } else {
          console.log("No hay películas");
        }


    } catch(error) {
	  console.error(error);
    }
}
fetchData();