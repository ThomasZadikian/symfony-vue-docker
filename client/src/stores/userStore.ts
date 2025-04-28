import { defineStore } from 'pinia';
import { User } from '../models/User';
import { userUseCase } from '../useCases/UserUseCase';
import { ref, Ref } from 'vue';

export const useUserStore = defineStore('user', () => {
  const users: Ref<User[]> = ref([]);
  const isLoading = ref(false);
  const error = ref<string | null>(null);

  async function loadUsers() {
    isLoading.value = true;
    error.value = null;

    try {
      const fetchedUsers = await userUseCase.fetchUsers();
      users.value = fetchedUsers;
    } catch (err) {
      error.value = 'Failed to load users';
      console.error(err);
    } finally {
      isLoading.value = false;
    }
  }

  async function addUser(name: string) {
    isLoading.value = true;
    error.value = null;

    try {
      const newUser = await userUseCase.addUser(name);
      users.value = [...users.value, newUser];
    } catch (err) {
      error.value = err instanceof Error ? err.message : 'Failed to add user';
      console.error(err);
    } finally {
      isLoading.value = false;
    }
  }

  return {
    users,
    isLoading,
    error,
    loadUsers,
    addUser,
  };
});
