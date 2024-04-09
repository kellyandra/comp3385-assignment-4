


<template>
    <form id="movieForm" @submit.prevent="saveMovie">
        <div class="form-group mb-3">
        <label for="title" class="form-label">Movie Title</label>
        <input type="text" id="title" name="title" v-model="movie.title" class="form-control" required />
        </div>
    
        <div class="form-group mb-3">
        <label for="description" class="form-label">Description</label>
        <input type="text" id="description" name="description" v-model="movie.description" class="form-control" required />
        </div>
    
        <div class="form-group mb-3">
        <label for="poster" class="form-label">Poster</label>
        <input type="file" id="poster" ref="poster" class="form-control" required />
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </template>
    
<script setup>
    import { ref } from 'vue';
    const movie =ref({ title:'', description:''});
    //const title =ref('');
    //const description=ref('');
    const poster=ref(null);

    const saveMovie=()=> { 
        let MovieForm = document.getElementById('movieForm');
        let formData = new FormData(movieForm);
        
        
        //const formData = new FormData();
        //formData.append("title", title.value);
        //formData.append( "description", description.value );

        if (poster.value.files[0]) {
            formData.append("poster", poster.value.files[0]);
        }

    
    fetch("/api/v1/movies", {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(function (response) {
        return response.json();
    })
    .then(function (data) {
    // display a success message
        console.log(data);
    })
    .catch(function (error) {
        console.log(error);
    });
}
    </script>

