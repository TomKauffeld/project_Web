class User {
    constructor(id, name, adminLvL) {
        this.id = id;
        this.name = name;
        this.adminLvL = adminLvL;
    }
}

class Comment {
    constructor(id, post, author, body, time) {
        this.id = id;
        this.post = post;
        this.author = author;
        this.body = body;
        this.time = time;
    }
}

class Post{
    constructor(id, author, title, body, time){
        this.id = id;
        this.author = author;
        this.title = title;
        this.body = body;
        this.time = time;
    }
}