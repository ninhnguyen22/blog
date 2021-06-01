import {Server, Model, Response} from 'miragejs'
import users from '../data/user'
import description from '../data/description'
import links from '../data/links'
import experiences from '../data/experiences'
import skills from '../data/skills'
import projects from '../data/projects'

export function makeServer({environment = "production"} = {}) {

    let server = new Server({
        environment,

        models: {
            user: Model,
            description: Model,
            links: Model,
            post: Model
        },

        seeds(server) {
            // User data
            server.schema.users.create(users);

            server.schema.posts.create({
                slug: "description",
                title: "description",
                metadata: description
            });

            server.schema.posts.create({
                slug: "links",
                title: "links",
                metadata: links
            });

            server.schema.posts.create({
                slug: "experiences",
                title: "experiences",
                metadata: experiences
            });
            server.schema.posts.create({
                slug: "skills",
                title: "skills",
                metadata: skills
            });
            server.schema.posts.create({
                slug: "projects",
                title: "projects",
                metadata: projects
            });

            // server.create("todo", {content: "Learn Mirage JS"})
            // server.create("todo", {content: "Integrate With Vue.js"})
        },

        routes() {

            this.namespace = "api"

            this.get("/users", schema => {
                let headers = {}
                return new Response(
                    200,
                    headers,
                    {
                        data: schema.users.first(),
                        message: `Successfully fetch user information`
                    }
                )
            })

            this.get("/posts", schema => {
                let headers = {}
                return new Response(
                    200,
                    headers,
                    {
                        data: schema.posts.all(),
                        message: `Successfully fetch posts information`
                    }
                )
            })

        },
    })

    return server
}
