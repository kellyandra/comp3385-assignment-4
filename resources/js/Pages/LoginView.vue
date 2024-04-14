<template>
<div class="login-container">
    <h1>Login</h1>
    <form @submit.prevent="login">
      <div class="form-group mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" id="email" v-model="loginForm.email" class="form-control"  required>
      </div>
      <div class="form-group mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" v-model="loginForm.password" class="form-control"  required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      loginForm: {
        email: '',
        password: '',
      },
    };
  },
  methods: {
    login() {
fetch('api/v1/login',{
  method: 'POST',
  HEADERS: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    },
    body: JSON.stringify(this.loginForm),
})
.then(response=>response.json())
.then(data=>{
  if(data.access_token) {
    localStorage.setItem('jwt', data.access_token);
    this.$router.push('/');
  }
  else {
    console.error('Login failed', data);
  }
})
.catch(error => {
        console.error('There was an error!', error);
      });
    }
  }
}; 
</script>