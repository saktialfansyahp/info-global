<template>
  <div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
        <div
          v-for="stat in stats"
          :key="stat.id"
          class="mx-auto flex max-w-xs flex-col gap-y-4"
        >
          <dt class="text-base leading-7 text-gray-600">{{ stat.name }}</dt>
          <dd
            class="order-first text-3xl font-semibold tracking-tight text-gray-900 sm:text-5xl"
          >
            {{ stat.value }}
          </dd>
        </div>
      </dl>
    </div>
  </div>
</template>

<script setup>
const stats = [
  { id: 1, name: "Transactions every 24 hours", value: "44 million" },
  { id: 2, name: "Assets under holding", value: "$119 trillion" },
  { id: 3, name: "New users annually", value: "46,000" },
];
</script>
<!-- <template>
  <v-container class="my-2" fluid>
    <v-row class="mx-auto" dense>
      <v-col cols="12" sm="6" md="3">
        <v-card color="#00000" theme="light">
          <v-card-title class="text-h6 text-uppercase"> Customer </v-card-title>

          <v-card-subtitle
            >Listen to your favorite artists and albums whenever and wherever,
            online and offline.</v-card-subtitle
          >

          <v-card-actions>
            <v-btn variant="text"> Listen Now </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>

      <v-col cols="12" sm="6" md="3">
        <v-card color="#1F7087" theme="dark">
          <v-card-title class="text-h6 text-uppercase"> Product </v-card-title>

          <v-card-subtitle
            >Listen to your favorite artists and albums whenever and wherever,
            online and offline.</v-card-subtitle
          >

          <v-card-actions>
            <v-btn variant="text"> Listen Now </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>

      <v-col cols="12" sm="6" md="3">
        <v-card color="#952175" theme="dark">
          <v-card-title class="text-h6 text-uppercase"> Invoice </v-card-title>

          <v-card-subtitle
            >Listen to your favorite artists and albums whenever and wherever,
            online and offline.</v-card-subtitle
          >

          <v-card-actions>
            <v-btn variant="text"> Listen Now </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>

      <v-col cols="12" sm="6" md="3">
        <v-card color="#952175" theme="dark">
          <v-card-title class="text-h6 text-uppercase"> Reminder </v-card-title>

          <v-card-subtitle
            >Listen to your favorite artists and albums whenever and wherever,
            online and offline.</v-card-subtitle
          >

          <v-card-actions>
            <v-btn variant="text"> Listen Now </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {};
</script> -->
