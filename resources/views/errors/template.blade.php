<!DOCTYPE html>
<html>
	<head>
		<title>My first three.js app</title>
		<style>
			body { 
                margin: 0;
            }
		</style>
	</head>
	<body>
        {{ $exception->getMessage() }}
		<script src="{{ asset('./js/three.js-master/build/three.js') }}"></script>
		<script>
			const scene = new THREE.Scene();
			const camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 1, 100000 );

			const renderer = new THREE.WebGLRenderer();
            renderer.setSize( window.innerWidth, window.innerHeight );
            renderer.setClearColor( 0x1a202c, 1);
            document.body.appendChild( renderer.domElement );

            window.addEventListener( 'resize', onWindowResize, false );

            /*const planeGeometry = new THREE.PlaneGeometry( 200, 200, 32, 32 );
            const planeMaterial = new THREE.MeshPhongMaterial( {color: 0xffff00, side: THREE.DoubleSide} );
            const plane = new THREE.Mesh( geometry, material );
            plane.receiveShadow = true;
            plane.position.y -= 100;
            scene.add( plane );*/

            const hemiLight = new THREE.HemisphereLight( 0x0000ff, 0x00ff00, 0.6 );
            scene.add( hemiLight );
            
            const light = new THREE.AmbientLight( 0x000000 ); // soft white light
            scene.add( light );

			camera.position.z = 700;

            const loader = new THREE.FontLoader();
            let font = undefined;
            loader.load("{{ URL::asset('./js/three.js-master/build/fonts/helvetiker_regular.typeface.json') }}", function ( response ) {
                font = response;
                loadText();
            } );

            function loadText() {
                const textgeometry = new THREE.TextGeometry( 'Not found - {{ $exception->getStatusCode()}}',{
                    font: font,
                    size: 60,
                    height: 1,
                    curveSegments: 12,
                    bevelEnabled: true,
                    bevelThickness: 10,
                    bevelSize: 2,
                    bevelOffset: 0,
                    bevelSegments: 5
                });

                const material = new THREE.MeshPhongMaterial( { color: 0xffffff } );
                textgeometry.center();
                let textMesh = new THREE.Mesh( textgeometry, material );
                textMesh.receiveShadow = true;
                scene.add(textMesh);

                const animate = function () {
                    requestAnimationFrame( animate );

                    //textMesh.rotation.x += 0.01;

                    if ((textMesh.rotation.y/3.141592)*180 >= 90) {
                        textMesh.rotation.y -= 3.141592;
                    } else {
                        textMesh.rotation.y += 0.01;
                    }

                    console.log()

                    renderer.render( scene, camera );
                };

                animate();
            }

            function onWindowResize(){
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();

                renderer.setSize( window.innerWidth, window.innerHeight );
            }

		</script>
	</body>
</html>