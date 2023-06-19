import 'package:flutter/material.dart';
import 'package:flutter/widgets.dart';
import '../models/article.dart';

class ArticlePreview extends StatefulWidget {

  final Article article;

  const ArticlePreview({super.key, required this.article});
  @override
  State<ArticlePreview> createState() => _ArticlePreview();
}

class _ArticlePreview extends State<ArticlePreview> {
  @override
  Widget build(BuildContext context) {
    return ListTile(
      title: const Text('Titre'),
      subtitle: const Column(
        children: [
          Text("Date de création"),
          Text("Auteur")
        ],
      ),
      onTap: () {
        print("click");
      },
    );
  }
}