<template>

    <div>
        <h4>{{bloque.clave}} + {{bloque.nombre}}</h4>
        <h5>Hola</h5>
    </div>
</template>

<script>
export default {

      data () {
            return {

                  name: 'detalleBloque',
                
                bloque: {
                  clave  : "",
                  nombre : "",
                  cve_curso : "",
                  cve_status : "",
                  version : "",
                  ruta_portal: ""
                  
               },
                
            }
        },
        created() {
            this.bloque.clave = this.$route.params.clave;
            this.bloque.nombre = this.$route.params.bloque.nombre
        },

}
</script>

<style>

</style>