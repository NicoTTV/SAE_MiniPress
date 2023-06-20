import 'dart:convert';

import 'package:http/http.dart' as http;

import 'article.dart';

class ArticleProvider {
  Future<List<Article>> fetchArticle() async {
    var response = await http.get(
        Uri.parse('http://docketu.iutnc.univ-lorraine.fr:41004/api/articles'));

    List<Article> articlesList = List.empty(growable: true);

    if (response.statusCode == 200) {
      var articlesJson = json.decode(response.body);
      for (var i in articlesJson) {
        articlesList.add(Article.fromJson(i));
      }
    }
    return Future<List<Article>>.value(articlesList);
  }
}
