<template>
    <transition name="fade" tag="div" class="wrapper" mode="out-in">
        <div class="wrapper" v-if="isLoaded" id="app">
            <LandingPage :user="user"/>
            <Description :user="user" :content="findSlug('description')" :links="findSlug('links')"/>
            <Experience :content="findSlug('experiences')"/>
            <Skills :content="findSlug('skills')"/>
            <Projects :content="findSlug('projects')"/>
            <Footer :user="user" :links="findSlug('links')"/>
        </div>
    </transition>
</template>

<script>
    import LandingPage from "./components/LandingPage.vue";
    import Description from "./components/Description.vue";
    import Experience from "./components/Experience.vue";
    import Skills from "./components/Skills.vue";
    import Projects from "./components/Projects.vue";
    import Footer from "./components/Footer.vue";

    export default {
        name: "App",
        components: {
            LandingPage,
            Description,
            Experience,
            Skills,
            Projects,
            Footer,
        },
        data: () => ({
            isLoaded: false,
            user: {},
            posts: [],
        }),
        methods: {

            fetchPosts() {
                return fetch("/api/posts");
            },

            fetchUser() {
                return fetch("/api/users");
            },

            findSlug(slug) {
                return this.posts.find((item) => {
                    return item.slug === slug;
                });
            }

        },
        created() {
            document.body.classList.add("loading");
            /* this.fetchPosts()
             this.fetchUser()
             this.isLoaded = true;*/
            this.$nextTick(() => document.body.classList.remove("loading"));
            Promise.all([this.fetchPosts(), this.fetchUser()]).then(async ([posts, user]) => {
                let user_response = await user.json()
                let user_data = user_response.data

                let posts_response = await posts.json()

                this.posts = await posts_response.data.models;
                console.log(posts_response.data)
                this.user = {
                    name: user_data.name,
                    status: user_data.status,
                    email: user_data.email,
                    phone: user_data.phone,
                    city: user_data.city,
                    lang: user_data.lang,
                    photo: user_data.photo,
                }
                this.isLoaded = true;
                this.$nextTick(() => document.body.classList.remove("loading"));
            });
        },
    };
</script>

<style scoped lang="scss">
    @import "@/styles/constants.scss";

    #app {
        font-family: Montserrat-Regular, serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        color: #2c3e50;
    }

    .wrapper {
        height: 100%;
    }
</style>
