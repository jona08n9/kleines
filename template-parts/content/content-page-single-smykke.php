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



<main id="main--single-smykke">

<div id="popup-container" class="hidden">
	<div id="close">&#x2715</div>
	<div class="popup-container--inner">
		<div class="popup-container--content">
			<video class="pop_product_video" autoplay muted loop>  <source src="" type="video/mp4"> </video>

			<img class="pop_product_pic" src="" alt="">
		</div>
	</div>
</div>

<div class="is-layout-flex wp-container-6 wp-block-columns alignfull">
	<div class="is-layout-flex wp-container-4 wp-block-columns alignfull are-vertically-aligned-top">

<section class="content_shape">

<div id="product_pics">
<div class="product_videos"></div>

</div>



<div class="product_info">
<h2 class="product_name"></h2>
<h3 class="price"></h3>
<p class="om-smykket--text">Om smykket:</p>
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

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>



<template>
<div>
	<img class="product_pic" src="" alt="">

</div>
</template>

<template id="material_container">
	<div class="material_container--inner">
		<img class="material_pic" src="" alt="">
		<p class="material_name"></p>
    </div>
</template>


<template id="video_template">
<video class="product_video" autoplay muted loop>

  <source src="" type="video/mp4"> 


</video> 
</template>

<script>

	let product;
	const product_pics_container = document.querySelector("#product_pics");
	const template = document.querySelector("template");
	const template_material = document.querySelector("#material_container");
	const materials_container = document.querySelector("#materials_container");
	const video_template = document.querySelector("#video_template");
	const product_videos_container = document.querySelector(".product_videos");

	const product_pic_show = document.querySelectorAll(".product_pic");
	const product_video_show = document.querySelectorAll(".product_video");

	let material_name_count = 0;

	

	const url="https://madvigux.dk/kleines/wp-json/wp/v2/smykke/"+<?php echo get_the_ID() ?>;
		async function getJson(){
			console.log("id er", <?php echo get_the_ID() ?> )
			let response = await fetch(url);
			product = await response.json();
			console.log(product);
			visProduct();
		}

		function visProduct(){
			
				document.querySelector(".product_name").textContent = product.title.rendered;
				document.querySelector(".product_text").textContent = `${product.kort_om_produktet}`;
				document.querySelector(".price").textContent = `Pris: ${product.pris} ,-`;
				

				product.poduktvideo.forEach(video => {

					const clone = video_template.cloneNode(true).content;
					clone.querySelector(".product_video").src = video.guid;
					clone.querySelector(".product_video").addEventListener("click", () => showVideo(video));
					product_videos_container.appendChild(clone);


				})


				product.produktbillede.forEach(picture => {

					const clone = template.cloneNode(true).content;
				clone.querySelector(".product_pic").src = picture.guid;
				clone.querySelector(".product_pic").addEventListener("click", () => showPicture(picture));
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

    const popup = document.querySelector("#popup-container");
	const popUpcontent = document.querySelector(".popup-container--content")
	const pop_video = document.querySelector(".pop_product_video")
	const pop_pic = document.querySelector(".pop_product_pic")
	const closePop = document.querySelector("#close");

	console.log("Indlæst const)")

	function showVideo(video) {

	if (window.matchMedia("(width >= 1000px)").matches) {
		console.log("Nothing to see here.");
	} else {
  //Toggle the class "hide" from the whole popup window
  popup.classList.toggle("hidden");
  pop_pic.classList.toggle("hidden");

  //Insert all information from dish to the specific tags
  document.querySelector(".pop_product_video").src = video.guid;

  // Add eventlistener for closing the popup box
  closePop.addEventListener("click", closeDetailsVideo);
  console.log("Åbnet ting - video");
}
	}

// Function for closing the pop-up
function closeDetailsVideo() {
  popup.classList.toggle("hidden");
  pop_pic.classList.toggle("hidden");
  closePop.removeEventListener("click", closeDetailsVideo);
  console.log("Lukket ting - video");
}

	function showPicture(picture) {

	if (window.matchMedia("(width >= 1000px)").matches) {
		console.log("Nothing to see here.");
	} else {
  //Toggle the class "hide" from the whole popup window
  popup.classList.toggle("hidden");
  pop_video.classList.toggle("hidden");

  //Insert all information from dish to the specific tags
  document.querySelector(".pop_product_pic").src = picture.guid;

  // Add eventlistener for closing the popup box
  closePop.addEventListener("click", closeDetailsPicture);
  console.log("Åbnet ting - picture");
}
	}

// Function for closing the pop-up
function closeDetailsPicture() {
  popup.classList.toggle("hidden");
  pop_video.classList.toggle("hidden");
  closePop.removeEventListener("click", closeDetailsPicture);
  console.log("Lukket ting - picture");
}


getJson();

</script>