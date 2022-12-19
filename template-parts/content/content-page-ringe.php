<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<main>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

<div class="is-layout-flex wp-container-6 wp-block-columns alignfull">
	<div class="is-layout-flex wp-container-4 wp-block-columns alignfull are-vertically-aligned-top">

<div class="content_shape">
	<div class="header_h1">
		<h1>Ringe</h1>
	</div>
	<div class="info_text">
		<p>Alle Kleines designs er unikke og priserne kan derfor variere. For mine produkter er der ca. 14 dages leveringstid. Har du nogle specifikke ønsker eller spørgsmål, så udfyld kontaktformuleren.</p>
	</div>

	<div class="loopview">
		<h3>Kleines smykke univers</h3>
		<div id="filter_buttons">
			<button  data-type="all" data-type_name="alle smykker">Alle smykker</button>
			<button data-type="7"  data-type_name="halskæder" >Halskæder</button>
			<button class="chosen" data-type="22" data-type_name="ringe" >Ringe</button>
			<button  data-type="3" data-type_name="øreringe" >Øreringe</button>
		</div>


		<section id="product_loopview_container" class="pin_container">

		</section>
	</div>

</div>
</div>
</div>
</article><!-- .post -->
</main>
<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>


<template>
<article class="product card ">

	<img class="main_product_pic" src="" alt="">
	<img class="like_icon" src="http://tobiasroland.dk/kea/10_eksamensopgave/kleines_tobias_domain/wordpress/wp-content/uploads/2022/12/heart.svg" alt="Tryk her for at gemme">
<img class="overlay" src="http://tobiasroland.dk/kea/10_eksamensopgave/kleines_tobias_domain/wordpress/wp-content/uploads/2022/12/overlay_test_3.png">
	<div class="product_quick_info">
	<p class="product_name"></p>
	<p class="product_price"></p>
	</div>
	
</article>
</template>

</article><!-- .post -->

<script>
// ********************             opretter variabler             **************************


	// variabler til filtrering
	let categories;
	let filter_product ="22";
	const catUrl ="https://madvigux.dk/kleines/wp-json/wp/v2/categories";

	  // variabler til at hente og indsætte producter
	  let products;
	  const product_loopview_container = document.querySelector("#product_loopview_container");
	  const template = document.querySelector("template");
	  const url = "https://madvigux.dk/kleines/wp-json/wp/v2/smykke?per_page=100";



	  // Henter json med producter og json med categorier
		async function getJson(){
			let response = await fetch(url);
			let catdata = await fetch(catUrl);
			products = await response.json();
			categories = await catdata.json();
			addEventListenerToButtons();
			showProducts();
			console.log(categories);
		}


		//  tilføjer eventListener til knapper, og kalder filter funktionen ved klik
		function addEventListenerToButtons(){
		document.querySelectorAll("#filter_buttons button").forEach(elm => {
		elm.addEventListener("click", filter);
			})
		}

		// tager værdien for dataset.sport på den knap der er 
	// blevet klikket på og tildeler denne værdi til variablen 
	// filter_sport. Herefter kaldes funktionen visHold.
	function filter(){

		document.querySelectorAll("#filter_buttons button").forEach(elm => {
			elm.classList.remove("chosen");
			
		})
		
		filter_product = this.dataset.type;
		this.classList.add("chosen");
		showProducts();

		document.querySelector(".header_h1 h1").textContent = this.dataset.type_name;

	}


		// funktionen startermed at rydde indhold i section med id product_loopview_container. herefter kører den et forEach loop på alle products i vores array.
		// inden at products kan blive vist bliver der tjekket om variablen filterproduct endten har værdien "all" eller om product indeholder den samme værdi som filter_products variablen.
		function showProducts(){

			product_loopview_container.innerHTML ="";

		products.forEach(product => {

		if (filter_product == "all" || product.categories.includes(parseInt(filter_product))){

			const clone = template.cloneNode(true).content;
			clone.querySelector(".main_product_pic").src = product.produktbillede[0].guid;
			clone.querySelector(".product_name").textContent = product.title.rendered;
			clone.querySelector(".product_price").textContent = product.pris;


			clone.querySelector(".product").addEventListener("click", () =>{
					location.href = product.link;})
		product_loopview_container.appendChild(clone);	
}})}


		getJson();

</script>