module.exports = {
    base: '/blog/',
    title: 'NinhNghia Blog',
    description: 'This is a blog example built by VuePress',
    theme: 'modern-blog', // OR shortcut: @vuepress/blog
    themeConfig: {
        /**
         * Ref: https://vuepress-theme-blog.ulivz.com/#modifyblogpluginoptions
         */
        modifyBlogPluginOptions(blogPlugnOptions) {
            const writingDirectoryClassifier = {
                id: 'writing',
                dirname: '_writings',
                path: '/writings/',
                layout: 'IndexWriting',
                itemLayout: 'Writing',
                itemPermalink: '/writings/:year/:month/:day/:slug',
                pagination: {
                    lengthPerPage: 5,
                },
            }
            blogPlugnOptions.directories.push(writingDirectoryClassifier)
            return blogPlugnOptions
        },
        /**
         * Ref: https://vuepress-theme-blog.ulivz.com/#nav
         */
        nav: [
            {
                text: 'Blog',
                link: '/',
            },
            {
                text: 'Tags',
                link: '/tag/',
            },
            {
                text: 'About me',
                link: 'https://ninhnguyen22.github.io/portfolio/',
            },
        ],
        /**
         * Ref: https://vuepress-theme-blog.ulivz.com/#footer
         */
        footer: {
            contact: [
                {
                    type: 'github',
                    link: 'https://github.com/ninhnguyen22',
                },
                {
                    type: 'facebook',
                    link: 'https://www.facebook.com/ninh.nguyen.988711',
                },
            ],
            copyright: [
                {
                    text: 'Privacy Policy',
                    link: 'https://policies.google.com/privacy?hl=en-US',
                },
                {
                    text: 'MIT Licensed | Copyright © 2018-present Vue.js',
                    link: '',
                },
            ],
        },
        sitemap: true,
        hostname: "https://ninhnguyen22.github.io/blog/",
        cookies: {
            theme: "dark-lime",
            buttonText: "Ok!",
        },
        heroImage: "https://source.unsplash.com/featured/?kawasaki",
        socialShare: true,
        socialShareNetworks: ["twitter", "facebook"],
    },
    dest: 'docs'
}
