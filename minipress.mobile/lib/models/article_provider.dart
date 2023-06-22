import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'article.dart';
import 'categorie.dart';

class ArticleProvider extends ChangeNotifier {
  List<Article> articlesList = List.empty(growable: true);
  dynamic article;

  Future<List<Article>> readData() {
    return Future.value(articlesList);
  }

  Future<dynamic> readArticle() {
    return Future.value(article);
  }

  fetchArticles() async {
    var response = await http.get(
        Uri.parse('http://docketu.iutnc.univ-lorraine.fr:41004/api/articles'));

    articlesList = List.empty(growable: true);
    if (response.statusCode == 200) {
      var articlesJson = json.decode(response.body);
      for (var i in articlesJson['articles']) {
        articlesList.add(Article.fromJson(i));
      }
      articlesList.sort((a, b) => b.dateCreation.compareTo(a.dateCreation));
    }
    notifyListeners();
  }

  fetchArticleByCategorie(idCategorie) async {
    var response = await http.get(Uri.parse(
        'http://docketu.iutnc.univ-lorraine.fr:41004/api/categories/${idCategorie}/articles'
    ));

    articlesList = List.empty(growable: true);
    if (response.statusCode == 200) {
      var articlesJson = json.decode(response.body);
      for (var i in articlesJson['articles']) {
        articlesList.add(Article.fromJson(i));
      }
      articlesList.sort((a, b) => b.dateCreation.compareTo(a.dateCreation));
    }
    notifyListeners();
  }
  
  fetchDetailsArticle(url) async {
    var response = await http.get(Uri.parse(
      'http://docketu.iutnc.univ-lorraine.fr:41004${url}'
    ));
    
    if (response.statusCode == 200) {
      var detailsArticle = json.decode(response.body);
      article = detailsArticle['article']['0'];
    }  
    notifyListeners();
  }

  // getDetailsByArticle(idArticle) async {
  //   var response = await http.get(Uri.parse(
  //     'http://docketu.iutnc.univ-lorraine.fr:41004/api/articles/${idArticle}'
  //   ));
  //   if (response.statusCode == 200) {
  //     var articlesJson = json.decode(response.body);
  //   }
  //   notifyListeners();
  // }
}
