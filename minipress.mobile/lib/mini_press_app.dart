import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import './screens/list_articles.dart';
import './screens/list_categ.dart';
import 'models/article_provider.dart';

class MiniPressApp extends StatefulWidget {
  const MiniPressApp({super.key});

  @override
  State<MiniPressApp> createState() => _MiniPressAppState();
}

class _MiniPressAppState extends State<MiniPressApp> {
  @override
  Widget build(BuildContext context) {
    Provider.of<ArticleProvider>(context, listen: false).fetchArticles();
    return MaterialApp(
      title: 'Mini Press',
      home: Scaffold(
        appBar: AppBar(
          title: const Text('Page d' 'accueil'),
        ),
        body: Column(
          children: <Widget>[
            const Expanded(child: ListCateg()),
            Expanded(
                flex: 10,
                child:
                    Container(color: Colors.blue, child: const ListArticles()))
          ],
        ),
      ),
      debugShowCheckedModeBanner: false,
    );
  }
}
