<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useUserStore } from '@/stores/userStore';

const userStore = useUserStore();
const newUser = ref('');

onMounted(() => {
  userStore.loadUsers();
});

const addUser = async () => {
  if (newUser.value.trim()) {
    await userStore.addUser(newUser.value);
    newUser.value = '';
  }
};
</script>

<template>
  <v-container>
    <v-card class="pa-4">
      <v-text-field v-model="newUser" label="Nom de l'utilisateur"></v-text-field>
      <v-btn color="primary" @click="addUser">Ajouter</v-btn>
    </v-card>

    <v-list>
      <v-list-item v-for="user in userStore.users" :key="user.id">
        {{ user.name }}
      </v-list-item>
    </v-list>
  </v-container>
</template>
