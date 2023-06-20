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
  List<Article> listArticles = <Article>[];

  // static getArticles() {
  //   return http.get(Uri.parse('http://docketu.iutnc.univ-lorraine.fr:41004/api/articles'));
  // }


  // Future<Article> _fetchArticle() async {
  //   final response = await http.get(Uri.parse('http://docketu.iutnc.univ-lorraine.fr:41004/api/articles'));
  //   print("coucou");
  //   if (response.statusCode == 200) {
  //     print("coucou");
  //     return Article.fromJson(jsonDecode(response.body));
  //   } else {
  //     throw Exception('Failed to load article');
  //   }
  // }

  Future fetchArticle() async {
    var response = await http.get(Uri.parse('http://docketu.iutnc.univ-lorraine.fr:41004/api/articles'));

    var articles = <Article>[];

    if (response.statusCode == 200) {

      var articlesJson = json.decode(response.body);
      for (var i in articlesJson) {
        articles.add(Article.fromJson(articlesJson));
      }
    }
    return articles;
  }

  @override
  Widget build(BuildContext context) {
    fetchArticle().then((value) => {
      setState(() {
        print("bonjour");
        listArticles.addAll(value);
      })   
    });

    return Scaffold(
      body: ListView.builder(
        itemBuilder: (context, index) {
          return Card(
            child: Padding(
              padding: const EdgeInsets.all(16.0),
              child: Column(
                children: <Widget>[
                  Text(
                    listArticles[index].titre
                  )
                ],
              ),
            ),
          );
        },
        itemCount: listArticles.length,
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
