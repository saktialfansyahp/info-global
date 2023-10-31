<template>
  <body class="h-full">
    <div
      class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8"
    >
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img
          class="mx-auto h-6 w-auto"
          src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
          alt="Your Company"
        />
        <h2
          class="mt-2 text-center text-xl font-bold leading-9 tracking-tight text-gray-900"
        >
          Sign in to your account
        </h2>
      </div>

      <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
        <form @submit.prevent="submitForm" class="space-y-6">
          <div>
            <label
              for="email"
              class="block text-sm font-medium leading-6 text-gray-900"
              >Email address</label
            >
            <div class="mt-2">
              <input
                id="email"
                name="email"
                type="text"
                v-model="username"
                autocomplete="email"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
              />
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label
                for="password"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Password</label
              >
            </div>
            <div class="mt-2">
              <input
                id="password"
                name="password"
                type="password"
                v-model="password"
                autocomplete="current-password"
                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
              />
            </div>
          </div>

          <div>
            <button
              class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
              Sign in
            </button>
          </div>
        </form>
        <TransitionRoot as="template" :show="alert">
          <Dialog as="div" class="relative z-10" @close="closeSuccessAlert">
            <TransitionChild
              as="template"
              enter="ease-out duration-300"
              enter-from="opacity-0"
              enter-to="opacity-100"
              leave="ease-in duration-200"
              leave-from="opacity-100"
              leave-to="opacity-0"
            >
              <div
                class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
              />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
              <div
                class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0"
              >
                <TransitionChild
                  as="template"
                  enter="ease-out duration-300"
                  enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                  enter-to="opacity-100 translate-y-0 sm:scale-100"
                  leave="ease-in duration-300"
                  leave-from="opacity-100 translate-y-0 sm:scale-100"
                  leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                  <DialogPanel
                    class="fixed transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
                  >
                    <div class="bg-white px-4 pb-2 pt-5 sm:p-6 sm:pb-4">
                      <div class="flex sm:flex sm:items-center">
                        <div class="mx-auto text-center sm:mt-0 sm:text-left">
                          <DialogTitle
                            as="h3"
                            class="text-base font-semibold leading-6 text-gray-900"
                          >
                            Success!
                          </DialogTitle>
                          <div class="mt-2 pb-4">
                            <p class="text-sm text-gray-500">
                              Login was successful. You will redirect to
                              Dashboard.
                            </p>
                          </div>
                          <div class="text-center">
                            <div role="status">
                              <svg
                                aria-hidden="true"
                                class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                  fill="currentColor"
                                />
                                <path
                                  d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                  fill="currentFill"
                                />
                              </svg>
                              <span class="sr-only">Loading...</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </DialogPanel>
                </TransitionChild>
              </div>
            </div>
          </Dialog>
        </TransitionRoot>
        <p class="mt-4 text-center text-sm text-gray-500">
          Not a member?
          {{ " " }}
          <router-link to="/signup">
            <a
              href="#"
              class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500"
              >Sign Up</a
            >
          </router-link>
        </p>
      </div>
    </div>
    <TransitionRoot as="template" :show="open">
      <Dialog as="div" class="relative z-10" @close="closeModals">
        <TransitionChild
          as="template"
          enter="ease-out duration-300"
          enter-from="opacity-0"
          enter-to="opacity-100"
          leave="ease-in duration-200"
          leave-from="opacity-100"
          leave-to="opacity-0"
        >
          <div
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
          />
        </TransitionChild>

        <div class="fixed inset-0 z-10 overflow-y-auto">
          <div
            class="flex min-h-full items-center justify-center p-4 text-center sm:items-center sm:p-0"
          >
            <TransitionChild
              as="template"
              enter="ease-out duration-300"
              enter-from="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
              enter-to="opacity-100 translate-y-0 sm:scale-100"
              leave="ease-in duration-300"
              leave-from="opacity-100 translate-y-0 sm:scale-100"
              leave-to="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            >
              <DialogPanel
                class="fixed transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
              >
                <div class="bg-white px-4 pb-2 pt-5 sm:p-6 sm:pb-4">
                  <div class="flex sm:flex sm:items-center">
                    <div class="mx-auto text-center sm:mt-0 sm:text-left">
                      <DialogTitle
                        as="h3"
                        class="text-base font-semibold leading-6 text-gray-900"
                        >{{ message }}</DialogTitle
                      >
                      <div class="mt-2">
                        <p class="text-sm text-gray-500">
                          {{ messageDesc }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6"
                >
                  <button
                    type="button"
                    class="mt-0 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                    @click="closeModals"
                    ref="cancelButtonRef"
                  >
                    Oke
                  </button>
                </div>
              </DialogPanel>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </body>
</template>

<script setup>
import {
  Dialog,
  DialogPanel,
  DialogTitle,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
// import { ExclamationTriangleIcon } from "@heroicons/vue/24/outline";
</script>

<script>
import axios from "axios";
// import { getCookie } from "/cookie";
import { mapActions } from "vuex";

export default {
  data() {
    return {
      username: "",
      password: "",
      token: "",
      message: "",
      messageDesc: "",
      // alert: false,
    };
  },
  computed: {
    open() {
      return this.$store.state.openModals;
    },
    alert() {
      return this.$store.state.alert;
    },
  },
  methods: {
    closeModals() {
      this.$store.state.openModals = false;
    },
    ...mapActions(["login"]),
    submitForm() {
      if (!this.username || !this.password) {
        // Tampilkan pesan kesalahan jika email atau password kosong
        this.message = "Email and password are required.";
        this.messageDesc = "Please fill in both fields before proceeding.";
        this.$store.state.openModals = true;
        return;
      }
      const credentials = {
        username: this.username,
        password: this.password,
      };
      this.login(credentials)
        .then(() => {})
        .catch((error) => {
          console.log(error);
          this.message = "Invalid Email or Password.";
          this.messageDesc =
            "The email and password combination you entered is incorrect. Please double-check your email and password and try again.";
        });
    },
    // async login() {
    //   const data = {
    //     username: this.username,
    //     password: this.password,
    //   };
    //   try {
    //     const response = await axios.post("http://localhost:8080/login", data);
    //     localStorage.setItem("token", response.data.token);
    //     localStorage.setItem("role", response.data.data.Role.name);
    //     localStorage.setItem("isLoggedIn", true);

    //     this.$router.push("/");
    //     // location.reload();
    //   } catch (error) {
    //     console.error(error);
    //     this.open = true;
    //   }
    // },
    product() {
      axios
        .get("http://localhost:8080/api/admin/product")
        .then((response) => {
          // localStorage.setItem("access_token", response.data.access_token);
          console.log(response.data);
          this.$router.push("/");
        })
        .catch((error) => {
          console.log(error);
          // this.errorMessage = error.response.data.error;
        });
    },
  },
};
</script>
