import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import 'package:minipress_mobile/models/article.dart';
import 'package:intl/intl.dart';
import 'article_preview.dart';
import 'package:http/http.dart' as http;

class ListArticles extends StatefulWidget {
  const ListArticles({super.key});

  @override
  State<ListArticles> createState() => _ListArticles();
}

class _ListArticles extends State<ListArticles> {

  late final Article article;
  List<Article> listArticles = [];

  late Future<Article> futureArticle;

  Future<Article> _fetchArticle() async {
    final response = await http.get(Uri.parse('http://docketu.iutnc.univ-lorraine.fr:41004/api/articles'));

    if (response.statusCode == 200) {
      return Article.fromJson(jsonDecode(response.body));
    } else {
      throw Exception('Failed to load article');
    }
  }

  @override
  void initState() {
    super.initState();
    futureArticle = _fetchArticle();
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Test',
      home: Scaffold(
        body: Center(
          child: FutureBuilder<Article>(
            future: futureArticle,
            builder: (context, snapshot) {
              if (snapshot.hasData) {
                return Text(snapshot.data!.titre);
              } else if (snapshot.hasError) {
                return const Text('Error');
              }
              return const CircularProgressIndicator();
            },
          )
        ),
      ),
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
