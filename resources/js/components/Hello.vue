<template>
 <h1>
     Hello {{duc.name}}
 </h1>
</template>

<script>
var data = {
   duc: {
       name: 'buihuynhduc',
       id: '1'
   }
};
export default {
    name: "Hello",
    data(){
        return data;
    }

}
</script>

<style scoped>

</style>
