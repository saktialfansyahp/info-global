<template>
  <v-container class="my-2" fluid>
    <div class="relative overflow-visible shadow-md sm:rounded-lg">
      <div class="pb-4 bg-white dark:bg-gray-900 mx-2 my-2">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative flex justify-between items-center">
          <div
            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
          >
            <svg
              class="w-4 h-4 text-gray-500 dark:text-gray-400"
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
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
              />
            </svg>
          </div>
          <input
            v-model="searchQuery"
            type="text"
            id="table-search"
            class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg sm:w-40 md:w-60 lg:w-80 bg-gray-50 py-1 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Search for items"
            @input="cek()"
          />
          <div class="relative">
            <Menu as="div" class="relative inline-block text-left">
              <div>
                <MenuButton
                  class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                >
                  Sort
                  <ChevronDownIcon
                    class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500"
                    aria-hidden="true"
                  />
                </MenuButton>
              </div>

              <transition
                enter-active-class="transition ease-out duration-100"
                enter-from-class="transform opacity-0 scale-95"
                enter-to-class="transform opacity-100 scale-100"
                leave-active-class="transition ease-in duration-75"
                leave-from-class="transform opacity-100 scale-100"
                leave-to-class="transform opacity-0 scale-95"
              >
                <MenuItems
                  class="absolute right-0 z-10 mt-2 w-40 origin-top-right rounded-md bg-white shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none"
                >
                  <div class="py-1 border-b border-gray-200">
                    <MenuItem
                      v-for="option in sortBy"
                      :key="option.name"
                      v-slot="{ active }"
                      class="cursor-pointer"
                    >
                      <a
                        :class="[
                          option.current
                            ? 'font-medium text-gray-900'
                            : 'text-gray-500',
                          active ? 'bg-gray-100' : '',
                          'block px-4 py-2 text-sm',
                        ]"
                        @click="changeProductSortBy(option)"
                        >{{ option.name }}</a
                      >
                    </MenuItem>
                  </div>
                  <div class="py-1">
                    <MenuItem
                      v-for="option in sortOptions"
                      :key="option.name"
                      v-slot="{ active }"
                      class="cursor-pointer"
                    >
                      <a
                        :class="[
                          option.current
                            ? 'font-medium text-gray-900'
                            : 'text-gray-500',
                          active ? 'bg-gray-100' : '',
                          'block px-4 py-2 text-sm',
                        ]"
                        @click="changeProductSort(option)"
                        >{{ option.name }}</a
                      >
                    </MenuItem>
                  </div>
                </MenuItems>
              </transition>
            </Menu>
            <button
              @click="navigate"
              type="button"
              class="text-gray-900 ms-2 bg-white border border-gray-300 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="w-3.5 h-3.5 mr-2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M12 4.5v15m7.5-7.5h-15"
                />
              </svg>
              Add Subcategory
            </button>
          </div>
        </div>
      </div>
      <div
        v-if="loading"
        class="text-center text-gray-600 ms-4 border-b border-gray-900/10 pb-10"
      >
        Loading...
      </div>
      <div v-else class="">
        <div
          v-if="phone.length < 1"
          class="ms-4 border-b border-gray-900/10 pb-10"
        >
          <h2
            class="text-base font-semibold leading-7 text-gray-900 text-center"
          >
            Product not available
          </h2>
        </div>
        <div v-else>
          <table
            class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
          >
            <thead
              class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
            >
              <tr>
                <th scope="col" class="p-4">
                  <div class="flex items-center">
                    <input
                      id="checkbox-all-search"
                      type="checkbox"
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      v-model="selectAll"
                      @change="toggleSelectAll"
                    />
                    <label for="checkbox-all-search" class="sr-only"
                      >checkbox</label
                    >
                  </div>
                </th>
                <th scope="col" class="px-6 py-3">Subcategory</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Category</th>
                <th scope="col" class="px-6 py-3">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="item in phone"
                :key="item.id"
                @click="detail(item.id)"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 cursor-pointer"
              >
                <td class="w-4 p-4">
                  <div class="flex items-center">
                    <input
                      :id="'checkbox-table-' + item.id"
                      type="checkbox"
                      class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                      v-model="selectedItems"
                      @change="selectItems"
                      :value="item.id"
                    />
                    <label :for="'checkbox-table-' + item.id" class="sr-only"
                      >checkbox</label
                    >
                  </div>
                </td>
                <td class="px-6 py-4 capitalize">{{ item.sub_category }}</td>
                <td class="px-6 py-4 capitalize">{{ item.description }}</td>
                <td class="px-6 py-4 capitalize">
                  {{ item.category.category }}
                </td>
                <td class="px-6 py-4">
                  <button
                    type="button"
                    @click="editSubcategory(item.id, $event)"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-xs px-2 py-1.5 mr-1 mb-1 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                  >
                    Edit
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <TransitionRoot as="template" :show="open">
      <Dialog as="div" class="relative z-10" @click="open = false">
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
                      class="animate-bounce mx-auto mt-4 mb-4 text-red-600 w-12 h-12 dark:text-gray-200"
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
                      class="mb-5 text-lg font-normal text-black-500 dark:text-gray-400"
                    >
                      Are you sure you want to delete this item?
                    </h3>
                    <div
                      class="bg-white-50 px-2 py-1 sm:flex sm:flex-row-reverse sm:px-6"
                    >
                      <button
                        type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"
                        @click="deleteProduct"
                      >
                        Delete
                      </button>
                      <button
                        type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                        @click="open = false"
                        ref="cancelButtonRef"
                      >
                        Cancel
                      </button>
                    </div>
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
  TransitionChild,
  TransitionRoot,
  Menu,
  MenuButton,
  MenuItem,
  MenuItems,
  // DialogPanel,
  // DialogTitle,
} from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
</script>

<script>
import axios from "axios";

export default {
  name: "customers-table",
  data() {
    return {
      phone: [],
      sortBy: [
        { name: "Sub_category", current: true },
        { name: "Description", current: false },
        { name: "Category", current: false },
      ],
      sortOptions: [
        { name: "Ascending", value: "ascending", current: true },
        { name: "Descending", value: "descending", current: false },
      ],
      selectedItems: [],
      selectAll: false,
      message: "",
      product_id: "",
      open: false,
      searchQuery: "",
      selectedSortBy: "Sub_category",
      sort: "ascending",
      loading: false,
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    cek() {
      this.loading = true;
      const search = this.searchQuery.toLowerCase();
      this.phone = [];
      axios
        .get(
          `/api/v1/sort/subcategory/${this.sort}/${this.selectedSortBy}?search=${search}`
        )
        .then((response) => {
          this.phone = response.data.data;
          console.log(response);
        })
        .catch((error) => {
          console.log(error.response.data);
        })
        .finally(() => {
          this.loading = false;
        });
    },
    detail(id) {
      // localStorage.setItem("history", this.$route.name);
      // this.$store.state.history = this.$route.name;
      // this.$router.push("about/editproduct/" + id);
      console.log(id);
    },
    openModals(id, event) {
      event.stopPropagation();
      this.product_id = id;
      this.open = true;
    },
    changeProductSort(selectedOption) {
      this.loading = true;
      const search = this.searchQuery.toLowerCase();
      this.selectedSortOption = selectedOption;
      this.sortOptions.forEach((option) => {
        option.current = option === selectedOption;
      });
      this.sort = selectedOption.value;
      this.phone = [];
      axios
        .get(
          `/api/v1/sort/subcategory/${this.sort}/${this.selectedSortBy}?search=${search}`
        )
        .then((response) => {
          this.phone = response.data.data;
          console.log(response);
        })
        .catch((error) => {
          console.log(error.response.data);
        })
        .finally(() => {
          this.loading = false;
        });
      console.log(this.selectedSortOption.value);
    },
    changeProductSortBy(selectedOption) {
      this.loading = true;
      const search = this.searchQuery.toLowerCase();
      this.selectedSortOption = selectedOption;
      this.sortBy.forEach((option) => {
        option.current = option === selectedOption;
      });
      this.selectedSortBy = selectedOption.name;
      this.phone = [];
      axios
        .get(
          `/api/v1/sort/subcategory/${this.sort}/${this.selectedSortBy}?search=${search}`
        )
        .then((response) => {
          this.phone = response.data.data;
          console.log(response);
        })
        .catch((error) => {
          console.log(error.response.data);
        })
        .finally(() => {
          this.loading = false;
        });
      console.log(this.selectedSortOption.name);
    },
    editSubcategory(id, event) {
      event.stopPropagation();
      localStorage.setItem("history", this.$route.name);
      this.$store.state.history = this.$route.name;
      this.$router.push("subcategory/editsubcategory/" + id);
    },
    navigate() {
      localStorage.setItem("history", this.$route.name);
      this.$store.state.history = this.$route.name;
      this.$router.push("/subcategory/addsubcategory");
    },
    fetchData() {
      this.loading = true;
      axios
        .get("/api/v1/subcategory")
        .then((response) => {
          this.phone = response.data.data;
          console.log(this.phone);
        })
        .catch((error) => {
          console.log(error);
        })
        .finally(() => {
          this.loading = false;
        });
    },
    toggleSelectAll() {
      if (this.selectAll) {
        this.selectedItems = this.phone.map((item) => item.id);
      } else {
        this.selectedItems = [];
      }
    },
    selectItems() {
      if (this.selectedItems.length == this.phone.length) {
        this.selectAll = true;
      } else {
        this.selectAll = false;
      }
    },
  },
};
</script>
