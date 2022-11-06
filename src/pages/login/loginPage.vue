<template>
  <q-page class="window-height window-width row justify-center items-center">
    <div class="column">
      <div class="row">
        <h5 class="text-h5 text-white q-my-md">Welcome To Open World</h5>
      </div>
      <div class="row">
        <q-card square bordered class="q-pa-lg">
          <q-card-section>
            <q-form class="q-gutter-md">
              <q-input square filled clearable v-model="user.username" type="email" label="Email" />
              <q-input square filled clearable v-model="user.password" type="password" label="Password" />
            </q-form>
          </q-card-section>
          <q-card-actions class="q-px-md">
            <q-btn @click="login" unelevated color="light-blue-8" size="lg" class="full-width" label="login"/>
          </q-card-actions>
          <q-card-section class="text-center q-pa-none">
          </q-card-section>
        </q-card>
      </div>
    </div>
  </q-page>
</template>

<script>
import { User } from 'src/models/user';
import { ref } from 'vue';
import { useAuthStore } from 'src/stores/auth-store'
import { useRouter } from 'vue-router';

const user = ref(new User('guest'));

export default {
    data () {
      const authStore = useAuthStore();
      const router = useRouter();
      return {
        user,
        login () {
          authStore
          .authenticate(user.value.username, user.value.password)
          .then(() => {
            router.replace({name: 'dashboard'})
          },
          (error) => {
            console.log(`No Internet, Connection Lost because server not serve!!!\n${error}`);
          })
        },
      }
    }
}
</script>

<style>
.q-page {
  background-image: url(../../image/loginWallpaper.jpg);
  background-repeat: no-repeat;
  background-size: cover;
}
.q-card {
  width: 400px;
}
</style>
