import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:minipress_mobile/models/article.dart';
import 'package:minipress_mobile/models/article_provider.dart';
import 'package:minipress_mobile/screens/article_preview.dart';

class ListArticles extends StatefulWidget {
  const ListArticles({super.key});

  @override
  State<ListArticles> createState() => _ListArticles();
}

class _ListArticles extends State<ListArticles> {
  late final Article article;
  List<Article> listArticles = <Article>[];

  @override
  Widget build(BuildContext context) {
    var articleProvider = ArticleProvider();
    return FutureBuilder(
      future: articleProvider.fetchArticle(),
        builder: ((context, snapshot) {
          if (snapshot.hasData) {
            return ListView.builder(
              itemCount: snapshot.data?.length,
              itemBuilder: (context, index) {
                return ArticlePreview(article: snapshot.data![index]);
              },
            );
          } else {
            return const Center(child: CircularProgressIndicator());
          }
        }
      )
    );
  }
}


    // return Scaffold(
    //   body: FutureBuilder(
    //     future: _fetchArticle(),
    //     builder: (BuildContext context, AsyncSnapshot snapshot) {
    //       if (snapshot.hasData) {
    //         return ListView.builder(
    //           itemCount: snapshot.data?.length,
    //           itemBuilder: (BuildContext context, int index) {
    //             return ArticlePreview(article: snapshot.data[index]);
    //           },
    //         );
    //       }
    //       else {
    //         return const Center(child: CircularProgressIndicator());
    //       }
    //     },
    //   ),
    // );
