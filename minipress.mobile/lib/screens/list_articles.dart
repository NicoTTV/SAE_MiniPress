import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:minipress_mobile/models/article.dart';
import 'package:minipress_mobile/models/article_provider.dart';
import 'package:minipress_mobile/screens/article_preview.dart';
import 'package:provider/provider.dart';

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
    return Consumer<ArticleProvider>(
      builder: (BuildContext context, articleProvider, child) {
        return FutureBuilder(
            future: articleProvider.readData(),
            builder: ((context, snapshot) {
              if (snapshot.hasData) {
                return Container(
                  margin: const EdgeInsets.symmetric(horizontal: 20),
                  child: ListView.builder(
                    itemCount: snapshot.data?.length,
                    itemBuilder: (context, index) {
                      return ArticlePreview(article: snapshot.data![index]);
                    },
                  ),
                );
              } else {
                return const Center(child: CircularProgressIndicator());
              }
            }));
      },
    );
  }
}