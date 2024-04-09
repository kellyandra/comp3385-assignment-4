<template>
<div>
    <h1>Movies</h1>
    <div v-for="movie in movies" :key="movie.id" class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img :src="`/storage/${movie.poster}`" alt="Movie Poster" />
            </div>
            <div class="col-md-8">
                <h3 class="card-title">{{ movie.title }}</h3>
                <p class="card-text">{{ movie.description }}</p>
            </div>
        </div>
    </div>
</div>
</template>



<script setup>
import { ref, onMounted } from "vue";
let movies = ref([]);

onMounted(() => {
    fetchMovies();
});


function fetchMovies() {
  fetch('/api/v1/movies', {
    headers: {
      'Accept': 'application/json',

      'Authorization': `Bearer ${localStorage.getItem('jwt')}`
    }
  })
  .then(response => response.json())
  .then(data => {
    movies.value = data.movies;
    console.log(data.movies);
  })
  .catch(error => console.error('Error:', error));
}


</script>


