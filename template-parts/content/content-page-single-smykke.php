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


<div class="is-layout-flex wp-container-6 wp-block-columns alignfull">
	<div class="is-layout-flex wp-container-4 wp-block-columns alignfull are-vertically-aligned-top">

<section class="content_shape">



<div id="product_pics">
	

</div>

<div class="product_info">
<h1 class="product_name"></h1>
<h2 class="price"></h2>
<p class="product_text"></p>

<div class="grid">
<div id="materials_container">
	
</div>
<button class="put_in_basket_btn">Læg i kurv</button>
</div>

</div>




	
</section>

</div> 
</div>

</main>


<template>
<div>
	<img class="product_pic" src="" alt="">

</div>
</template>

<template id="material_container">
	<img class="material_pic" src="" alt="">
	<p class="material_name"></p>
</template>

<script>

	let product;
	const product_pics_container = document.querySelector("#product_pics");
	const template = document.querySelector("template");
	const template_material = document.querySelector("#material_container");
	const materials_container = document.querySelector("#materials_container");
	let material_name_count = 0;

	

	const url="http://tobiasroland.dk/kea/10_eksamensopgave/kleines_tobias_domain/wordpress/wp-json/wp/v2/smykke/"+<?php echo get_the_ID() ?>;
		async function getJson(){
			console.log("id er", <?php echo get_the_ID() ?> )
			let response = await fetch(url);
			product = await response.json();
			console.log(product);
			visProduct();
		}

		function visProduct(){
			
				document.querySelector(".product_name").textContent = product.title.rendered;
				document.querySelector(".product_text").textContent = product.kort_om_produktet;
				document.querySelector(".price").textContent = product.pris;
				
				product.produktbillede.forEach(picture => {

					const clone = template.cloneNode(true).content;
				clone.querySelector(".product_pic").src = picture.guid;
				product_pics_container.appendChild(clone);
				})

				product.material_pic.forEach(elm => {
					const clone = template_material.cloneNode(true).content;
					// console.log(material_name[0]);
				clone.querySelector(".material_pic").src = elm.guid;

				clone.querySelector(".material_name").textContent = product.material_name[material_name_count];
				material_name_count ++;


				materials_container.appendChild(clone);

				
				})


			
				
				
			
				
				
				}

				
				

		
				






				
				


getJson();

</script>