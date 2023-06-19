import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:minipress_mobile/models/article.dart';
import 'package:intl/intl.dart';
import 'article_preview.dart';

class ListArticles extends StatefulWidget {
  const ListArticles({super.key});

  @override
  State<ListArticles> createState() => _ListArticles();
}

class _ListArticles extends State<ListArticles> {

  late final Article article;
  List<Article> listArticles = [];

  Future<List<Article>> _fetchTask() {
    for (var i = 0; i < 20; i++) {
      listArticles.add(Article(
        titre: "titre",
        dateCreation: DateTime.now(),
        auteur: "auteur"
      ));
    }
    return Future<List<Article>>.value(listArticles);
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: FutureBuilder(
        future: _fetchTask(),
        builder: (BuildContext context, AsyncSnapshot snapshot) {
          if (snapshot.hasData) {
            return ListView.builder(
              itemCount: snapshot.data?.length,
              itemBuilder: (BuildContext context, int index) {
                return ArticlePreview(article: snapshot.data[index]);
              },
            );
          }
          else {
            return const Center(child: CircularProgressIndicator());
          }
        },
      ),
    );
  }
}