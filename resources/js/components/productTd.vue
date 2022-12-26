<template>

    <div id="td_view_content">
    </div>

</template>


<script>

import * as THREE from 'three';
import {
    GLTFLoader
} from 'three/addons/loaders/GLTFloader.js';

import {OrbitControls} from 'three/addons/controls/OrbitControls.js';


const renderer = new THREE.WebGLRenderer();
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(60, 1.7, 0.1, 10000);

export default {
    props: ['file_name', 'path'],
    mounted() {


        this.init();
    },
    name: 'product-td',
    methods: {
        create() {

        },
        init() {


            const clock = new THREE.Clock();

            // const scene = new THREE.Scene();


            // const camera = new THREE.PerspectiveCamera(60, 600 / 300, 0.1, 1000000);
            camera.position.set(1, 1, 1);

            const controls = new OrbitControls(camera, renderer.domElement);
            controls.target.set(0, 0, 0);
            controls.update();

            const light1 = new THREE.DirectionalLight(0xcccccc, 2);
            light1.position.set(10, 10, 50);
            scene.add(light1);

            scene.add(new THREE.AmbientLight(0xcccccc));


            let element = document.getElementById('td_view_content');
            // this.renderer = new THREE.WebGLRenderer();
            renderer.setSize(700, 350);
            element.appendChild(renderer.domElement);


            const assetPath = this.path;

            const loader = new GLTFLoader();
            loader.setPath(assetPath);

            loader.load(this.file_name, object => {

                object.scene.position.set(0, 0, 0);

                scene.add(object.scene);
                this.update();
            });


            this.update();


        },
        update() {
            requestAnimationFrame(this.update);
            renderer.render(scene, camera);
            // const dt = clock.getDelta();

            // const time = this.clock.getElapsedTime();


        }
    },
    data() {
        return {
            clock: null,
            scene: null,
            camera: null,
            renderer: null,
            mixer: null,
            avva: '',
        }
    },
}

</script>
