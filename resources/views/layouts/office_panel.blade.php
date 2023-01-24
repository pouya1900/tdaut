@include('front.includes.layout_top')

<style>
    body {
        height: 100%;
    }
</style>

@include('front.partials.load_screen')

@include('office.includes.background')

@yield('content')

@include('front.includes.layout_bottom')

<script async src="https://unpkg.com/es-module-shims@1.3.6/dist/es-module-shims.js"></script>

<script type="importmap">
  {
    "imports": {
      "three": "https://cdn.jsdelivr.net/npm/three@0.140.0/build/three.module.min.js"
    }
  }


</script>
<script type="module" src="storage/js/office-background-threejs.js"></script>






