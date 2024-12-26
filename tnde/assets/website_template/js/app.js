

// particlesJS.load('particles-js', 'partikel_data_json', function() {
//   console.log('particles.js loaded - callback');
// });

// particlesJS.load('particles-js', 'partikel_data_json', function() {
//   console.log('particles.js loaded - callback');
// });


particlesJS(
				'particles-js',
				{
					"particles": 
					{
						"number": 
						{
							"value": 80,
							"density": 
							{
							"enable": true,
							"value_area": 1025.8919341219544
							}
						},
						"color": 
						{
							"value": "#ffffff"
						},
						"shape": 
						{
							"type": "circle",
							"stroke":
							{
								"width": 0,
								"color": "#000000"
							},
							"polygon": 
							{
								"nb_sides": 7
							},
							"image": 
							{
								"src": "img/github.svg",
								"width": 200,
								"height": 100
							}
						},
						"opacity": 
						{
							"value": 0.6894671861721748,
							"random": false,
							"anim": 
							{
								"enable": true,
								"speed": 1.4617389821424212,
								"opacity_min": 0.1,
								"sync": false
							}
						},
						"size": 
						{
							"value": 3,
							"random": true,
							"anim": 
							{
								"enable": false,
								"speed": 21.926084732136317,
								"size_min": 0.1,
								"sync": false
							}
						},
						"line_linked": 
						{
							"enable": true,
							"distance": 208.44356791251798,
							"color": "#ffffff",
							"opacity": 0.4,
							"width": 1
						},
						"move": 
						{
							"enable": true,
							"speed": 2,
							"direction": "top",
							"random": false,
							"straight": false,
							"out_mode": "out",
							"bounce": false,
							"attract": 
							{
								"enable": false,
								"rotateX": 600,
								"rotateY": 1200
							}
						}
					},
					"interactivity": 
					{
						"detect_on": "canvas",
						"events": 
						{
							"onhover": 
							{
								"enable": false,
								"mode": "grab"
							},
							"onclick": 
							{
								"enable": true,
								"mode": "push"
							},
							"resize": true
						},
						"modes": 
						{
							"grab": 
							{
								"distance": 400,
								"line_linked": 
								{
									"opacity": 1
								}
							},

							"bubble": 
							{
								"distance": 400,
								"size": 40,
								"duration": 2,
								"opacity": 8,
								"speed": 3
							},
							"repulse": 
							{
								"distance": 200,
								"duration": 0.4
							},
							"push": 
							{
								"particles_nb": 4
							},
							"remove": 
							{
								"particles_nb": 2
							}
						}
					},
					"retina_detect": true
				}

			);
