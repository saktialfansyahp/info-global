<template>
  <v-container class="my-2" fluid>
    <form @submit.prevent="editProduct">
      <div class="space-y-12">
        <div class="ms-4 border-b border-gray-900/10 pb-12">
          <h2 class="text-base font-semibold leading-7 text-gray-900">
            Edit Color
          </h2>
          <p
            class="border-b border-gray-900/10 pb-10 mt-1 text-sm leading-6 text-gray-600"
          >
            Provide the details for your subcategory.
          </p>

          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-1">
            <div class="sm:col-span-2 sm:w-1/4">
              <label
                for="subcategory-name"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Subcategory</label
              >
              <div class="mt-2">
                <input
                  type="text"
                  name="subcategory_name"
                  v-model="subcategory.sub_category"
                  id="subcategory-name"
                  autocomplete="given-name"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
              </div>
            </div>
          </div>
          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-1">
            <div class="sm:col-span-2 sm:w-1/4">
              <label
                for="subcategory-name"
                class="block text-sm font-medium leading-6 text-gray-900"
                >Description</label
              >
              <div class="mt-2">
                <input
                  type="text"
                  name="subcategory_name"
                  v-model="subcategory.description"
                  id="subcategory-name"
                  autocomplete="given-name"
                  class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                />
              </div>
            </div>
          </div>
          <div class="mt-10 sm:col-span-2 sm:w-1/4">
            <Listbox as="div" v-model="selectedCategory">
              <ListboxLabel
                class="block text-sm font-medium leading-6 text-gray-900"
                >Category</ListboxLabel
              >
              <div class="relative mt-2">
                <ListboxButton
                  class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6"
                >
                  <span class="flex items-center">
                    <!-- <img
                        :src="selected.avatar"
                        alt=""
                        class="h-5 w-5 flex-shrink-0 rounded-full"
                      /> -->
                    <span
                      v-if="!selectedCategory"
                      class="ml-3 block truncate capitalize"
                      >Choose Category</span
                    >
                    <span v-else class="ml-3 block truncate capitalize">{{
                      selectedCategory.category
                    }}</span>
                  </span>
                  <span
                    class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2"
                  >
                    <ChevronUpDownIcon
                      class="h-5 w-5 text-gray-400"
                      aria-hidden="true"
                    />
                  </span>
                </ListboxButton>

                <transition
                  leave-active-class="transition ease-in duration-100"
                  leave-from-class="opacity-100"
                  leave-to-class="opacity-0"
                >
                  <ListboxOptions
                    class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
                  >
                    <ListboxOption
                      as="template"
                      v-for="person in category"
                      :key="person.id"
                      :value="person"
                      v-slot="{ active, selectedCategory }"
                    >
                      <li
                        :class="[
                          active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                          'relative cursor-default select-none py-2 pl-3 pr-9',
                        ]"
                      >
                        <div class="flex items-center">
                          <!-- <img
                              :src="person.avatar"
                              alt=""
                              class="h-5 w-5 flex-shrink-0 rounded-full"
                            /> -->
                          <span
                            :class="[
                              selectedCategory
                                ? 'font-semibold'
                                : 'font-normal',
                              'ml-3 block truncate capitalize',
                            ]"
                            >{{ person.category }}</span
                          >
                        </div>

                        <span
                          v-if="selectedCategory"
                          :class="[
                            active ? 'text-white' : 'text-indigo-600',
                            'absolute inset-y-0 right-0 flex items-center pr-4',
                          ]"
                        >
                          <CheckIcon class="h-5 w-5" aria-hidden="true" />
                        </span>
                      </li>
                    </ListboxOption>
                  </ListboxOptions>
                </transition>
              </div>
            </Listbox>
          </div>
        </div>
      </div>

      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button
          type="button"
          @click="navigate"
          class="text-sm font-semibold leading-6 text-gray-900"
        >
          Cancel
        </button>
        <button
          type="submit"
          class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
        >
          Save
        </button>
      </div>
    </form>
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
              <div class="relative w-full max-w-md max-h-full">
                <div
                  class="relative bg-white rounded-lg shadow dark:bg-gray-700"
                >
                  <button
                    type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="popup-modal"
                  >
                    <svg
                      class="w-3 h-3"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 14 14"
                    >
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                      />
                    </svg>
                    <span class="sr-only">Close modal</span>
                  </button>
                  <div class="p-6 text-center">
                    <svg
                      class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                      aria-hidden="true"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 20 20"
                    >
                      <path
                        stroke="currentColor"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                      />
                    </svg>
                    <h3
                      class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400"
                    >
                      {{ message }}
                    </h3>
                    <button
                      data-modal-hide="popup-modal"
                      type="button"
                      @click="navigate"
                      class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                    >
                      Oke
                    </button>
                  </div>
                </div>
              </div>
            </TransitionChild>
          </div>
        </div>
      </Dialog>
    </TransitionRoot>
  </v-container>
</template>

<script setup>
import {
  Dialog,
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
  TransitionChild,
  TransitionRoot,
} from "@headlessui/vue";
</script>

<script>
import axios from "axios";

export default {
  name: "addProduct",
  data() {
    return {
      category: [],
      open: false,
      subcategory: {},
      selectAll: false,
      message: "",
      success: true,
      subcategory_id: "",
      res: [],
      selectedCategory: "",
    };
  },
  unmounted() {
    this.$store.commit("setHistory", null);
    localStorage.removeItem("history");
  },
  beforeMount() {
    this.subcategory_id = this.$route.params.id;
    this.fetchData();
    this.fetchCategory();
  },
  methods: {
    fetchCategory() {
      axios
        .get("/api/v1/category")
        .then((response) => {
          this.category = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    fetchData() {
      axios
        .get("/api/v1/subcategory/" + this.subcategory_id)
        .then((response) => {
          const item = response.data.data;
          console.log(response);
          this.subcategory = {
            sub_category: item.sub_category,
            description: item.description,
            category_id: item.category_id,
          };
          this.selectedCategory = item.category;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    editProduct() {
      this.subcategory.category_id = this.selectedCategory.id;
      axios
        .put("/api/v1/subcategory/" + this.subcategory_id, this.subcategory)
        .then((response) => {
          console.log(response.data);
          this.message = "Subcategory data has been successfully updated.";
          this.success = true;
          this.open = true;
        })
        .catch((error) => {
          console.log(error);
          this.open = true;
          this.message = "Failed to update subcategory. Please try again.";
          this.success = false;
        });
    },
    navigate() {
      if (this.success == true) {
        this.open = false;
        this.$router.push("/subcategory");
      } else {
        this.open = false;
      }
    },
  },
};
</script>
