<template>
    <div>
        <cards>
            <template v-if="authenticated">
                <a class="card" href="/reisigers-info">
                    <img src="@/assets/images/main/ris.png" alt="Reizigersinformatie">
                    <h3>Reizigersinformatie</h3>
                </a>
                <a class="card" href="/">
                    <img src="@/assets/images/main/scanner.png" alt="Scanner">
                    <h3>Scanner</h3>
                </a>
                <a class="card" href="/mailchimp">
                    <img src="@/assets/images/main/mailchimp.png" alt="Mailchimp">
                    <h3>Mailchimp</h3>
                </a>
                <a class="card" href="/trainmap">
                    <img src="@/assets/images/main/map.png" alt="TrainMap">
                    <h3>TrainMap</h3>
                </a>
                <a class="card" href="/scm-team">
                    <img src="@/assets/images/main/scmteam.png" alt="SCM-Team">
                    <h3>SCM-Team</h3>
                </a>
                <a class="card" href="/">
                    <img src="@/assets/images/main/forms.png" alt="SCM-Formulieren">
                    <h3>SCM-Formulieren</h3>
                </a>
                <a class="card" href="/academy">
                    <img src="@/assets/images/main/academy.png" alt="SCM-Academy">
                    <h3>SCM-Academy</h3>
                </a>
            </template>
            <a class="card" href="https://login.one.com/cp/">
                <img src="@/assets/images/main/one.png" alt="One.com">
                <h3>One.com</h3>
            </a>
            <a class="card" href="https://www.stoomtreinmaldegem.be/nl/">
                <img src="@/assets/images/main/stme.png" alt="Stoomtrein Maldegem-Eeklo">
                <h3>Stoomtrein Maldegem</h3>
            </a>
        </cards>
    </div>
</template>

<script>
import Cards from '@/components/Cards.vue';
import { mapGetters } from 'vuex'

export default {
    name: 'home',
    components: {
        'cards': Cards
    },
    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user'
        })
    }
}
</script>

<style>
</style>