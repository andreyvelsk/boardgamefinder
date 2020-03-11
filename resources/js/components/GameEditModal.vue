<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in items" :key="category.id">
                        <td>{{ category.name }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</template>

<script>
    export default {

        data() {
            return {
              items: {},
              itemsname: 'artists'
            }
        },
        methods: {
            getInfo(){
                axios.get('/admin/' + this.itemsname + '/json')
                     .then((response)=>{
                       this.items = response.data
                     })
            }
        },
        created() {
            this.getInfo()
        }
    }
</script> 