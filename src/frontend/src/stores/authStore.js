import { defineStore } from 'pinia';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: null,
    userId: null,
    username: null,
    name: null,
    userType: null,
  }),
  actions: {
    setToken(token) {
      this.token = token;
    },
    clearToken() {
      this.token = null;
    },
    setUserId(userId) {
      this.userId = userId;
    },
    clearUserId() {
      this.userId = null;
    },
    setUsername(username) {
      this.username = username;
    },
    clearUsername() {
      this.username = null;
    },
    setName(name) {
      this.name = name;
    },
    clearName() {
      this.name = null;
    },
    setUserType(userType) {
      this.userType = userType;
    },
    clearUserType() {
      this.userType = null;
    },
    clearAll() {
      this.token = null;
      this.userId = null;
      this.username = null;
      this.name = null;
      this.userType = null;
    },
    logout() {
      this.clearAll();
      sessionStorage.clear(); // Clear session storage
    },
  },
  getters: {
    isAuthenticated: (state) => !!state.token,
    getUserId: (state) => state.userId,
    getUsername: (state) => state.username,
    getUserType: (state) => state.userType,
    getName: (state) => state.name,
    getToken: (state) => state.token,
  },
  persist: {
    storage: sessionStorage,
  },
});