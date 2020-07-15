<template>
    <div>
        <h1>Reizigersinformatiesysteem</h1>
        <cards>
            <a class="card" href="/reisigers-info/weergave">
                <img src="@/assets/images/split/content.png" alt="TrainMap">
                <h3>Weergave Borden</h3>
            </a>
            <a class="card" href="/reisigers-info/info-borden">
                <img src="@/assets/images/split/status.png" alt="Scanner">
                <h3>Info Borden</h3>
            </a>
        </cards>
    </div>
</template>

<script>
import Cards from '@/components/Cards.vue';

export default {
    name: 'app',
    components: {
        'cards': Cards
    }
}
</script>

<style>
</style>