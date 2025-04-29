<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useUserStore } from '../stores/userStore';

const userStore = useUserStore();
const newUserName = ref('');

onMounted(() => {
  userStore.loadUsers();
});

async function addUser() {
  if (newUserName.value.trim()) {
    await userStore.addUser(newUserName.value);
    userStore.isLoading = true;
  }
  userStore.loadUsers();
}
</script>

<template>
  <div class="user-list-container">
    <h2>Gestionnaire des utilisateurs</h2>

    <div class="user-form">
      <input
        v-model="newUserName"
        placeholder="Enter user name"
        @keyup.enter="addUser"
        :disabled="userStore.isLoading"
        class="user-input"
      />
      <button
        @click="addUser"
        :disabled="userStore.isLoading || !newUserName.trim()"
        class="add-button"
      >
        {{ userStore.isLoading ? 'Création...' : 'Ajouter utilisateur' }}
      </button>
    </div>

    <p v-if="userStore.error" class="error-message">{{ userStore.error }}</p>

    <div v-if="userStore.isLoading && userStore.users.length === 0" class="loading">
      Loading users...
    </div>

    <div v-else-if="userStore.users.length === 0" class="empty-state">
      No users found. Add a new user to get started.
    </div>

    <ul v-else class="user-list">
      <li v-for="(user, index) in userStore.users" :key="user?.id || index" class="user-item">
        <div class="user-details">
          <span class="user-name">{{ user?.name || 'Création en cours...' }}</span>
          <span class="user-id">ID: {{ user?.id || "Attribution d'un ID en cours" }}</span>
        </div>
      </li>
    </ul>
  </div>
</template>

<style scoped>
.user-list-container {
  width: 100%;
  max-width: 600px;
  margin: 0 auto;
  padding: 1.5rem;
  background-color: white;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
  color: #2c3e50;
  margin-bottom: 1.5rem;
  text-align: center;
}

.user-form {
  display: flex;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
}

.user-input {
  flex: 1;
  padding: 0.6rem 1rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 1rem;
  transition: border-color 0.2s;
}

.user-input:focus {
  border-color: #3498db;
  outline: none;
}

.add-button {
  background-color: #3498db;
  color: white;
  border: none;
  padding: 0.6rem 1.2rem;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.2s;
}

.add-button:hover:not(:disabled) {
  background-color: #2980b9;
}

.add-button:disabled {
  background-color: #95a5a6;
  cursor: not-allowed;
}

.error-message {
  color: #e74c3c;
  margin-bottom: 1rem;
  padding: 0.5rem;
  background-color: #fde2e2;
  border-radius: 4px;
}

.loading {
  text-align: center;
  color: #7f8c8d;
  padding: 1rem;
}

.empty-state {
  text-align: center;
  color: #7f8c8d;
  padding: 1.5rem;
  background-color: #f9f9f9;
  border-radius: 4px;
}

.user-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.user-item {
  padding: 1rem;
  border-bottom: 1px solid #eee;
  transition: background-color 0.2s;
}

.user-item:hover {
  background-color: #f7f9fc;
}

.user-item:last-child {
  border-bottom: none;
}

.user-details {
  display: flex;
  flex-direction: column;
  gap: 0.25rem;
}

.user-name {
  font-weight: 600;
  color: #2c3e50;
}

.user-id,
.user-date {
  font-size: 0.85rem;
  color: #7f8c8d;
}
</style>
